<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ApplicationRegistration;
use App\Models\Enroll;
use App\Models\Faculty;
use App\Models\Programme;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ApplicationRegistrationController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = ApplicationRegistration::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('academic_year', function($row){
                    return $row->academic_year->name;
                })
                ->addColumn('count_received', function($row){
                    $reg = Enroll::where([['academic_year_id',$row->academic_year_id],['programme_id',$row->programme_id],['status','Registered']])->count();
                    $total = Enroll::where([['academic_year_id',$row->academic_year_id],['programme_id',$row->programme_id]])->count();
                    $x = $total>0? round(($reg/$total)*100,0):0;
                   $data =  '<div class="progress progress-xl animated-progess" style="height: 20px;" >
                        <div class="progress-bar bg-primary" role="progressbar" style="width: '.$x.'%" aria-valuenow="'.$x.'" aria-valuemin="0" aria-valuemax="'.$x.'">
                            '.$x.'%
                        </div>
                    </div>';
                    return $data;
                })
                ->addColumn('count_called', function($row){
                    $reg = Enroll::where([['academic_year_id',$row->academic_year_id],['programme_id',$row->programme_id],['status','Registered']])->count();
                    $total = Enroll::where([['academic_year_id',$row->academic_year_id],['programme_id',$row->programme_id]])->count();
                    $x = $total>0? round(($reg/$total)*100,0):0;
                    return sprintf("%03d",$reg).'/'.sprintf("%03d",$total).' ('.sprintf("%02d",$x).'%)';
                })
                ->addColumn('programme', function($row){
                    return $row->programme->name;
                })
                ->addColumn('next_registration_number', function($row){
                    return $row->academic_year->application_year.'/'.$row->programme->abbreviation.'/'.sprintf("%03d",$row->next_registration_number);
                })
                ->addColumn('action', function($row){
                    $btn = '
                    <div class="dropdown dropleft" >
                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <h5 class="dropdown-header">Registration</h5>
                        <a class="dropdown-item" href="'.route('admin.enroll.assign.reg.index',['pid'=>$row->programme_id,'aid'=>$row->academic_year_id]).'"  data-toggle="tooltip" data-placement="top" title="Assign Registration Number"><i class="mdi mdi-account-lock font-size-18"></i> Assign Registration No.</a>
                        <a class="dropdown-item" href="'.route('admin.enroll.clear.reg.index',['pid'=>$row->programme_id,'aid'=>$row->academic_year_id]).'"   data-toggle="tooltip" data-placement="top" title="Delete Registration Number"><i class="mdi mdi-account-remove font-size-18 text-warning"></i> Clear Registration No.</a>
                        <div class="dropdown-divider"></div>
                        <h5 class="dropdown-header">Email</h5>
                        <a class="dropdown-item" href="'.route('admin.enroll.confirmation',['app_id'=>$row->id]).'"   data-toggle="tooltip" data-placement="top" title=" Confirmation of Enrolment"><i class="mdi mdi-email-send font-size-18"></i> Confirmation of Enrolment</a>
                        <div class="dropdown-divider"></div>
                        <h5 class="dropdown-header">Students</h5>
                        <a class="dropdown-item" href="'.route('admin.students.program.academic',['pid'=>$row->programme_id,'aid'=>$row->academic_year_id,'status'=>'all']).'"  data-toggle="tooltip" data-placement="top" title="View All Students"><i class="fas fa-users font-size-18"></i> List of Students</a>
                        <div class="dropdown-divider"></div>
                        <h5 class="dropdown-header">Applications</h5>
                        <a class="dropdown-item" href="'.route('admin.application.registrations.edit',['id'=>$row->id]).'"   data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i> Edit</a>
                        ';
                    if($row->status =='Draft') {
                        $btn .= '<a  class="dropdown-item text-danger sa-warning" id ="exam' . $row->id . '" data-exam="' . $row->id . '" data-toggle="tooltip" data-placement="top" title="Delete"  ><i class="uil uil-trash-alt font-size-18"> </i> Delete</a>';
                    }
                        $btn.='</div></div>';
                    return $btn;
                })
                ->rawColumns(['action','count_received'])
                ->make(true);
        }
        return view('application.registration.index');
    }
    public function add(){
        $programmes = Programme::orderBy('name','asc')->get();
        $academics = AcademicYear::orderBy('application_year','desc')->get();
        return view('application.registration.add-edit',['academics'=>$academics,'programmes'=>$programmes]);
    }
    public function addEditProcess(Request $request){
        $this->validate($request, [
            'academic_year_id' => 'required|int',
            'programme_id' => 'required|int',
            'open_date' => 'required|date',
            'close_date' => 'required|date',
            'account_number'=>'required|integer',
            'deposit_amount'=>'required|numeric'
        ]);
    $open_date = Carbon::parse($request['open_date']);
    $close_date = Carbon::parse($request['close_date']);
    $now = Carbon::now();

    if($now->diffInDays($open_date,false)<0 || $open_date->diffInDays($close_date,false)<3){
        return back()->with(['error'=>'Please select a closing date that is at least three days from calling date / Calling date not before today']);
    }

        $isUpdate = false;
        if ($request['id']) {
            $registration = ApplicationRegistration::whereId($request['id'])->first();
            $isUpdate = true;
        }
        else{
            $registration = new ApplicationRegistration();
            $check = ApplicationRegistration::where([['academic_year_id',$request['academic_year_id']],['programme_id',$request['programme_id']]])->first();
            if($check){
                $message =  $check->programme->name.' registration already exists in '.$check->academic_year->name.' academic year';
                $msag_type = 'warning';
                return redirect()->route('admin.application.registrations.index')->with(['message_type'=>$msag_type,'message'=>$message]);
            }
        }
        $registration->academic_year_id = $request['academic_year_id'];
        $registration->programme_id = $request['programme_id'];
        $registration->open_date = $request['open_date'];
        $registration->close_date = $request['close_date'];
        $registration->status = $request['status'];
        $registration->account_number = $request['account_number'];
        $registration->deposit_amount = $request['deposit_amount'];

        try{
            if ($isUpdate && $registration->update()) {
                $message =  $registration->programme->name . ' successfully updated';
                $msag_type = 'success';
            } else {
                $registration->save();
                $message = $registration->programme->name. ' successfully created';
                $msag_type = 'success';
            }
        }
        catch (QueryException $exception){
            $message = $exception;
            $msag_type = 'error';
        }
        return redirect()->route('admin.application.registrations.index')->with(['message_type'=>$msag_type,'message'=>$message]);
    }
    public function edit($id) {
        $programmes = Programme::orderBy('name','asc')->get();
        $academics = AcademicYear::orderBy('application_year','desc')->get();
        $ea = ApplicationRegistration::whereId($id)->first();
        return view('application.registration.add-edit',['ea'=>$ea,'academics'=>$academics,'programmes'=>$programmes]);
    }
    public function delete($id){
        $exam = ApplicationRegistration::where([['id',$id],['status','Draft']])->first();
        $enroll= Enroll::where([['programme_id',$exam->programme_id],['academic_year_id',$exam->academic_year_id]])->count();
        if($enroll>0){
            return response()->json(['msg'=>'Students were there, you cannot delete this','code'=>201]);

        }
        try{
            $exam->delete();
            $code = 200;
            $msg = $exam->name;
        }catch (QueryException $ex){
            $msg = $ex->getMessage();
            $code = 201;
        }
        return response()->json(['msg'=>$msg,'code'=>$code]);
    }
}
