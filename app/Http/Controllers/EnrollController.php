<?php

namespace App\Http\Controllers;

use App\Jobs\EnrolmentConfirmationJob;
use App\Jobs\SendMessageJob;
use App\Models\AcademicYear;
use App\Models\ApplicationRegistration;
use App\Models\Enroll;
use App\Models\Faculty;
use App\Models\Programme;
use App\Models\Student;
use App\Services\JobScheduleService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollController extends Controller
{
    private function getEnrolls($pid,$aid,$status){
        return    $enrolls = Enroll::leftJoin('students','students.id','=','enrolls.student_id')
            ->where([['enrolls.programme_id',$pid],['enrolls.academic_year_id',$aid],['enrolls.status',$status]])
            ->orderBy('students.full_name','asc')
            ->get();
    }
    private function checkParams($pid, $aid){
        $programme = Programme::whereId($pid)->first();
        $academic = AcademicYear::whereId($aid)->first();
        if(!$academic || !$programme){
            return redirect()->route('admin.application.registrations.index');
        }
    }
    public function assignRegistrationNoIndex($pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls = $this->getEnrolls($pid,$aid,'Accepted');
        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        return view('enroll.assign',['enrolls'=>$enrolls,'application'=>$application]);
    }
    public function clearRegistrationNoIndex($pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls = $this->getEnrolls($pid,$aid,'Registered');

        $updated = Enroll::where([['enrolls.programme_id',$pid],['enrolls.academic_year_id',$aid],['enrolls.status','Registered']])->
        orderBy('updated_at','desc')->first();
        $updated_at = $updated? $updated->updated_at: null;
        $now = Carbon::now('Asia/Colombo');
        $isVisible = ($now->diffInHours($updated_at, false)< -36);



        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        return view('enroll.clear',['enrolls'=>$enrolls,'application'=>$application,'isNotVisible'=>$isVisible]);
    }
    private function generateRegNo(ApplicationRegistration $application){
        return $application->academic_year->application_year.'/'.$application->programme->abbreviation.'/'.sprintf("%03d",$application->next_registration_number);
    }
    private function generateIndexNo(ApplicationRegistration $application){
        $regnos = preg_split("#/#", $application->programme->abbreviation);
        $regno = "";
        foreach($regnos as $key=>$value) {
            $regno .= "$value";
        }
        return $regno.substr($application->academic_year->application_year,2,2).sprintf("%03d",$application->next_registration_number);
    }
    public function assignRegistrationNoProcess(Request $request,$pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls = Enroll::select('enrolls.id as id')->leftJoin('students','students.id','=','enrolls.student_id')
            ->where([['enrolls.programme_id',$pid],['enrolls.academic_year_id',$aid],['enrolls.status','Accepted']])
            ->orderBy('students.full_name','asc')
            ->get();

        //get scheduled time
        $jobService = new JobScheduleService();
        $schedule = $jobService->getSchedule();
        $sms_scheduled_at = Carbon::parse($schedule->sms_scheduled_at);
        $email_scheduled_at = Carbon::parse($schedule->email_scheduled_at);
        $gmail_schedule = config('app.gmail_schedule');

        //GET ENV varilables
        $scheduled_at = $gmail_schedule['scheduled_at'];
        $delay_bulk = $gmail_schedule['delay_bulk'];
        $limit = $gmail_schedule['limit'];
        $delay_one = $gmail_schedule['delay_one'];
        $count = 0;


        foreach ($enrolls as $en){
            DB::beginTransaction();
            $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
            $reg_no = $application->academic_year->application_year.'/'.$application->programme->abbreviation.'/'.sprintf("%03d",$application->next_registration_number);
            //$index_no = $this->generateIndexNo($application); //$application->programme->abbreviation.substr($application->academic_year->application_year,2,2).sprintf("%03d",$application->next_registration_number);
            $enroll = Enroll::whereId($en->id)->first();
            $enroll->reg_no = $reg_no;
            //$enroll->index_no = $index_no;
            $enroll->registration_date= $request['date'];
            $enroll->status = 'Registered';
            try {
                $application->next_registration_number += 1;
                $application->update();
                $enroll->update();

                ($count>=$limit && $count%$limit==0) ? $scheduled_at = $scheduled_at + $delay_bulk : $scheduled_at += $delay_one;
                $count++;
                //send sms
                $message = "Congratulations, You are enrolled for ".$application->programme->name." at University of Jaffna. Your Registration Number: ".$enroll->reg_no.". Check your MyUoJ portal for further details";
                $job_sms = (new SendMessageJob($enroll->student->mobile,$message))
                    ->delay(
                        $sms_scheduled_at->addSecond()
                    );
                dispatch($job_sms);

                //email job
                $job = (new EnrolmentConfirmationJob($enroll->id))
                    ->delay(
                        $email_scheduled_at->addSeconds($scheduled_at)
                    );
                dispatch($job);
                DB::commit();
            }catch(QueryException $e){
                DB::rollBack();
            }
        }

        //update schedule
        $jobService->updateSchedule($email_scheduled_at,$sms_scheduled_at);

        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        $message = $application->programme->name. '\'s registration details successfully updated!';
        $msag_type = 'success';
        return redirect()->route('admin.enroll.assign.reg.index',['pid'=>$application->programme_id,'aid'=>$application->academic_year_id])->with(['message_type'=>$msag_type,'message'=>$message]);

    }
    public function assignRegistrationNoDelete($pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls = Enroll::where([['enrolls.programme_id',$pid],['enrolls.academic_year_id',$aid],['enrolls.status','Registered']])
            ->get();
        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        $application->next_registration_number = 1;
        $application->update();
        foreach ($enrolls as $enroll){
            DB::beginTransaction();
                $enroll->reg_no = null;
                $enroll->index_no = null;
                $enroll->registration_date=null;
                $enroll->status='Accepted';
                try {
                    $enroll->update();
                    DB::commit();
                } catch (QueryException $e) {
                    DB::rollBack();
                }

        }

        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        $message = $application->programme->name. '\'s registration details successfully cleared!';
        $msag_type = 'success';
        return redirect()->route('admin.enroll.assign.reg.index',['pid'=>$application->programme_id,'aid'=>$application->academic_year_id])->with(['message_type'=>$msag_type,'message'=>$message]);
    }
    public function changeCourseStudy($id){
        $enroll = Enroll::whereId($id)->first();
        $programmes = Programme::orderBy('name','asc')->get();
        $ays = AcademicYear::orderBy('name','desc')->get();
        return view('enroll.change',['enroll'=>$enroll,'programmes'=>$programmes,'academics'=>$ays]);
    }
    public function changeCourseStudyProcess(Request $request,$id){
        $this->validate($request,[
           'programme_id'=>'required',
            'academic_year_id'=>'required',
            'date'=>'required',
        ]);
        DB::beginTransaction();
        $application = ApplicationRegistration::where([['programme_id',$request['programme_id']],['academic_year_id',$request['academic_year_id']]])->first();
        $enroll = Enroll::whereId($id)->first();

        if(!$application){
            $message = 'Application doesnt exists';
            $msag_type = 'warning';
            return redirect()->back()->with(['message_type'=>$msag_type,'message'=>$message]);

        }
        if($request['programme_id']==$enroll->programme_id && $request['academic_year_id'] == $enroll->academic_year_id){
            $message = 'Already enrolled!';
            $msag_type = 'warning';
            return redirect()->back()->with(['message_type'=>$msag_type,'message'=>$message]);
        }

        //update status of students log
        $student = Student::whereId($enroll->student_id)->first();
        $log = new \stdClass();
        $log->previews = $enroll->status;
        $log->now = "Transferred";
        $log->date = $request['date'];
        $log->comments = "";
        $log->created_at = Carbon::now();
        $log->created_by = auth()->user()->name;
        $log->p_programme= $enroll->programme->name;
        $log->p_ay = $enroll->academic_year->name;
        $log->p_reg = $enroll->reg_no;

        if($student->comments) $data= json_decode($student->comments,true);else $data = [];
        array_push($data,$log);
        $student->comments = json_encode($data);


        $reg_no = $this->generateRegNo($application);
        $index_no = $this->generateIndexNo($application);
        $enroll->reg_no = $reg_no;
        //$enroll->index_no = $index_no;
        $enroll->registration_date= $request['date'];
        $enroll->programme_id = $request['programme_id'];
        $enroll->academic_year_id = $request['academic_year_id'];
        $enroll->status = 'Registered';


        try {
            $application->next_registration_number += 1;
            $application->update();
            $enroll->update();
            $student->update();
            $message = $enroll->reg_no. ' successfully updated';
            $msag_type = 'success';
            DB::commit();
        }catch(QueryException $e){
            $message = $e;
            $msag_type = 'error';
            DB::rollBack();

        }
        return redirect()->back()->with(['message_type'=>$msag_type,'message'=>$message]);

    }


    public function getRegNo($pid,$aid){
        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        if($application){
            $reg_no = $this->generateRegNo($application);
            $index_no = $this->generateIndexNo($application);
        }else{
            $reg_no = "N/A";
            $index_no = "N/A";
        }
        return response()->json(['reg_no'=>$reg_no,'index_no'=>$index_no],200);
    }

    public function changeReg($id){
        $enroll = Enroll::whereId($id)->first();
        $programmes = Programme::orderBy('name','asc')->get();
        $ays = AcademicYear::orderBy('name','desc')->get();
        return view('enroll.reg',['enroll'=>$enroll,'programmes'=>$programmes,'academics'=>$ays]);
    }
    public function changeRegProcess(Request $request,$id){
//        'index_no' => 'sometimes|required|unique:enrolls,index_no,'.$id,
        $this->validate($request,[
            'reg_no' => 'sometimes|required|unique:enrolls,reg_no,'.$id,
            'date'=>'required',
        ]);
        $request['index_no'] ? $this->validate($request,['index_no' => 'sometimes|required|unique:enrolls,index_no,'.$id]):'';
        $enroll = Enroll::whereId($id)->first();
        $enroll->registration_date= $request['date'];
        $enroll->reg_no = strtoupper($request['reg_no']);
        $enroll->index_no = $request['index_no']?strtoupper($request['index_no']):null;
        try {
            $enroll->update();
            $message = $enroll->reg_no. ' successfully updated';
            $msag_type = 'success';
        }catch(QueryException $e){
            $message = $e;
            $msag_type = 'error';
        }
        return redirect()->back()->with(['message_type'=>$msag_type,'message'=>$message]);

    }

    public function confirmation($app_id){
        $application = ApplicationRegistration::whereId($app_id)->first();
        $enrolls = Enroll::where([['enrolls.programme_id',$application->programme_id],['enrolls.academic_year_id',$application->academic_year_id],['enrolls.status','Registered']])
            ->orderBy('reg_no','asc')
            ->get();
        return view('enroll.confirmation',['enrolls'=>$enrolls,'application'=>$application]);
    }
    public function confirmationProcess($app_id){
        $application = ApplicationRegistration::whereId($app_id)->first();
        $enrolls = Enroll::where([['enrolls.programme_id',$application->programme_id],['enrolls.academic_year_id',$application->academic_year_id],['enrolls.status','Registered']])
            ->orderBy('reg_no','asc')
            ->get();

        $gmail_schedule = config('app.gmail_schedule');

        //GET ENV varilables
        $scheduled_at = $gmail_schedule['scheduled_at'];
        $delay_bulk = $gmail_schedule['delay_bulk'];
        $limit = $gmail_schedule['limit'];
        $delay_one = $gmail_schedule['delay_one'];
        $count = 0;
        foreach ($enrolls as $enroll){
            ($count>=$limit && $count%$limit==0) ? $scheduled_at = $scheduled_at + $delay_bulk : $scheduled_at += $delay_one;
            $count++;
            // send all mail in the queue.
            $job = (new EnrolmentConfirmationJob($enroll->id))
                ->delay(
                    now()->addSeconds($scheduled_at)
                );
            dispatch($job);
        }
        return redirect()->back()->with(['message_type'=>'success','message'=>'Email has been placed in queue for the process. Queue will be start '.$gmail_schedule['scheduled_at'].' second latter.']);
    }
    public function dropout($enroll_id){
        $enroll = Enroll::whereId($enroll_id)->first();
        $status = config('app.enroll_status');
        return view('enroll.dropout',['enroll'=>$enroll,'status'=>$status]);
    }

    public function dropoutProcess($enroll_id,Request $request){
        $enroll = Enroll::whereId($enroll_id)->first();
        $status = config('app.enroll_status');

        $student = Student::whereId($enroll->student_id)->first();

        $log = new \stdClass();
        $log->previews = $enroll->status;
        $log->now = $request['status'];
        $log->date = $request['date'];
        $log->comments = $request['comments'];
        $log->created_at = Carbon::now();
        $log->created_by = auth()->user()->name;
        $log->p_programme= $enroll->programme->name;
        $log->p_ay = $enroll->academic_year->name;
        $log->p_reg = $enroll->reg_no;


        if($student->comments) $data= json_decode($student->comments,true);else $data = [];
        array_push($data,$log);
        $student->comments = json_encode($data);

        $student->update();

        $enroll->status = $request['status'];
        $enroll->update();

        return redirect()->back()->with(['message_type'=>'success','message'=>'Update Successfully']);

    }

    public function assignIndexNumber($pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls = Enroll::leftJoin('students','students.id','=','enrolls.student_id')
            ->where([['enrolls.programme_id',$pid],['enrolls.academic_year_id',$aid],['enrolls.status','Registered']])->whereNull('enrolls.index_no')
            ->orderBy('enrolls.reg_no','asc')
            ->get();
        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        $faculty = Faculty::whereId($application->programme->faculty_id)->first();
        return view('enroll.assign_index',['enrolls'=>$enrolls,'application'=>$application,'faculty'=>$faculty]);
    }
    public function assignIndexProcess(Request $request,$pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls = Enroll::select('enrolls.id as id')->leftJoin('students','students.id','=','enrolls.student_id')
            ->where([['enrolls.programme_id',$pid],['enrolls.academic_year_id',$aid],['enrolls.status','Registered']])->whereNull('enrolls.index_no')
            ->orderBy('enrolls.reg_no','asc')
            ->get();

        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();

        $jobService = new JobScheduleService();
        $schedule = $jobService->getSchedule();
        $sms_scheduled_at = Carbon::parse($schedule->sms_scheduled_at);
        $email_scheduled_at = Carbon::parse($schedule->email_scheduled_at);
        foreach ($enrolls as $en){
            DB::beginTransaction();
            $faculty = Faculty::whereId($application->programme->faculty_id)->first();

            $index_no = $faculty->abbreviation.sprintf("%05d",$faculty->next_index_number);
            $enroll = Enroll::whereId($en->id)->first();
            $enroll->index_no = $index_no;
            try {
                $faculty->next_index_number += 1;
                $faculty->update();
                $enroll->update();

                //send sms
                $message = "Your Index Number: ".$enroll->index_no.". Check your MyUoJ portal for further details";
                $job_sms = (new SendMessageJob($enroll->student->mobile,$message))
                    ->delay(
                        $sms_scheduled_at->addSecond()
                    );
                dispatch($job_sms);

                DB::commit();
            }catch(QueryException $e){
                DB::rollBack();
            }
        }
        $jobService->updateSchedule($email_scheduled_at,$sms_scheduled_at);

        $message = $application->programme->name. '\'s index numbers has been successfully updated!';
        $msag_type = 'success';
        return redirect()->route('admin.enroll.assign.index.number',['pid'=>$application->programme_id,'aid'=>$application->academic_year_id])->with(['message_type'=>$msag_type,'message'=>$message]);

    }
    public function clearIndexNumberIndex($pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls = $this->getEnrolls($pid,$aid,'Registered');
        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        return view('enroll.clear_index',['enrolls'=>$enrolls,'application'=>$application]);
    }
    public function clearIndexNumberProcess($pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls = Enroll::where([['enrolls.programme_id',$pid],['enrolls.academic_year_id',$aid],['enrolls.status','Registered']])
            ->get();
        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        foreach ($enrolls as $enroll){
            DB::beginTransaction();
            $enroll->index_no = null;
            try {
                $enroll->update();
                DB::commit();
            } catch (QueryException $e) {
                DB::rollBack();
            }

        }
        $message = $application->programme->name. '\'s index details successfully cleared!';
        $msag_type = 'success';
        return redirect()->route('admin.enroll.clear.index.number',['pid'=>$application->programme_id,'aid'=>$application->academic_year_id])->with(['message_type'=>$msag_type,'message'=>$message]);
    }
}
