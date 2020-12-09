<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AcademicYearController extends Controller
{

    public function index(Request $request){
        if ($request->ajax()) {
            $data = AcademicYear::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                    <a href="'.route('admin.academic.years.edit',['id'=>$row->id]).'" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i></a>
                     <a  class="px-3 text-danger sa-warning" id ="exam'.$row->id.'" data-exam="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Delete"  ><i class="uil uil-trash-alt font-size-18"></i></a>
                   ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('academic-year.index');
    }

    public function add(){
        return view('academic-year.add-edit');
    }
    public function edit($id) {
        $ay = AcademicYear::where('id',$id)->first();
        return view('academic-year.add-edit',['ay'=>$ay]);
    }
    public function addEditProcess(Request $request)
    {
        $this->validate($request,[
            'application_year' => 'sometimes|required|int|min:2000|max:9999|unique:academic_years,application_year,'.$request['id'],
            'academic_year' => 'sometimes|required|unique:academic_years,name,'.$request['id']
        ]);
        $isUpdate = false;
        if ($request['id']) {
            $ay = AcademicYear::where('id', $request['id'])->first();
            $isUpdate = true;
        }
        else{
            $ay = new AcademicYear();
        }
        $ay->application_year = $request['application_year'];
        $ay->name = $request['academic_year'];
        $ay->date_of_start  = $request['start'];
        $ay->date_of_end = $request['end'];
        $ay->status = $request['status'];

        try{
        if ($isUpdate && $ay->update()) {
            $message =  $ay->name . ' successfully updated';
            $msag_type = 'success';
        } else {
            $ay->save();
            $message = $ay->name. ' successfully created';
            $msag_type = 'success';
        }
        }catch (QueryException $exception){
        $message = $exception;
        $msag_type = 'error';
    }
        return redirect()->route('admin.academic.years.index')->with(['message_type'=>$msag_type,'message'=>$message]);
    }

    public function delete($id){
        $exam = AcademicYear::whereId($id)->first();
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
