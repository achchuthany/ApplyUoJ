<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ApplicationRegistration;
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
                ->addColumn('programme', function($row){
                    return $row->programme->name;
                })
                ->addColumn('action', function($row){
                    $btn = '
                    <a href="'.route('admin.application.registrations.edit',['id'=>$row->id]).'" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i></a>';
                    if($row->status =='Draft')
                        $btn.= '<a  class="px-3 text-danger sa-warning" id ="exam'.$row->id.'" data-exam="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Delete"  ><i class="uil uil-trash-alt font-size-18"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
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
            'close_date' => 'required|date'
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
