<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ApplicationRegistration;
use App\Models\Enroll;
use App\Models\Programme;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollController extends Controller
{
    private function getEnrolls($pid,$aid,$status){
        return    $enrolls = Enroll::leftJoin('students','students.id','=','enrolls.student_id')
            ->where([['enrolls.programme_id',$pid],['enrolls.academic_year_id',$aid],['enrolls.status',$status]])
            ->orderBy('students.name_initials','asc')
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
        return $application->programme->abbreviation.substr($application->academic_year->application_year,2,2).sprintf("%03d",$application->next_registration_number);
    }
    public function assignRegistrationNoProcess(Request $request,$pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls =$this->getEnrolls($pid,$aid,'Accepted');
        foreach ($enrolls as $enroll){
            DB::beginTransaction();
            $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
            $reg_no = $application->academic_year->application_year.'/'.$application->programme->abbreviation.'/'.sprintf("%03d",$application->next_registration_number);
            $index_no = $application->programme->abbreviation.substr($application->academic_year->application_year,2,2).sprintf("%03d",$application->next_registration_number);
            $enroll->reg_no = $reg_no;
            $enroll->index_no = $index_no;
            $enroll->registration_date= $request['date'];
            $enroll->status = 'Registered';
            try {
                $application->next_registration_number += 1;
                $application->update();
                $enroll->update();
                DB::commit();
            }catch(QueryException $e){
                DB::rollBack();
            }
        }

        $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
        $message = $application->programme->name. '\'s registration details successfully updated!';
        $msag_type = 'success';
        return redirect()->route('admin.enroll.assign.reg.index',['pid'=>$application->programme_id,'aid'=>$application->academic_year_id])->with(['message_type'=>$msag_type,'message'=>$message]);

    }
    public function assignRegistrationNoDelete($pid,$aid){
        $this->checkParams($pid,$aid);
        $enrolls =$this->getEnrolls($pid,$aid,'Registered');
        foreach ($enrolls as $enroll){
            DB::beginTransaction();
            $application = ApplicationRegistration::where([['programme_id',$pid],['academic_year_id',$aid]])->first();
                $enroll->reg_no = null;
                $enroll->index_no = null;
                $enroll->registration_date=null;
                $enroll->status='Accepted';
                try {
                    $application->next_registration_number -= 1;
                    $application->update();
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

        $reg_no = $this->generateRegNo($application);
        $index_no = $this->generateIndexNo($application);
        $enroll->reg_no = $reg_no;
        $enroll->index_no = $index_no;
        $enroll->registration_date= $request['date'];
        $enroll->programme_id = $request['programme_id'];
        $enroll->academic_year_id = $request['academic_year_id'];
        $enroll->status = 'Registered';
        try {
            $application->next_registration_number += 1;
            $application->update();
            $enroll->update();
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
}
