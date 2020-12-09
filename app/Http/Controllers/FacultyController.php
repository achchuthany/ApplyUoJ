<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class FacultyController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Faculty::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                    <a href="'.route('admin.faculties.edit',['id'=>$row->id]).'" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i></a>
                     <a  class="px-3 text-danger sa-warning" id ="exam'.$row->id.'" data-exam="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Delete"  ><i class="uil uil-trash-alt font-size-18"></i></a>
                   ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('faculty.index');
    }
    public function add(){
        return view('faculty.add-edit');
    }
    public function addEditProcess(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'abbreviation' => 'sometimes|required|unique:faculties,abbreviation,'.$request['id']
        ]);
        $success=$warning=null;
        $isUpdate = false;
        if ($request['id']) {
            $faculty = Faculty::whereId($request['id'])->first();
            $isUpdate = true;
        }
        else{
            $faculty = new Faculty();
        }
        $faculty->name = trim($request['name']);
        $faculty->abbreviation = strtoupper(trim($request['abbreviation']));

        try{
            if ($isUpdate && $faculty->update()) {
                $message =  $faculty->name . ' successfully updated';
                $msag_type = 'success';
            } else {
                $faculty->save();
                $message = $faculty->name. ' successfully created';
                $msag_type = 'success';
            }
        }
        catch (QueryException $exception){
            $message = $exception;
            $msag_type = 'error';
        }
        return redirect()->route('admin.faculties.index')->with(['message_type'=>$msag_type,'message'=>$message]);
    }
    public function edit($id) {
        $faculty = Faculty::whereId($id)->first();
        return view('faculty.add-edit',['faculty'=>$faculty]);
    }
    public function delete($id){
    $exam = Faculty::whereId($id)->first();
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
