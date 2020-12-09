<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Programme;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProgrammeController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Programme::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('faculty', function($row){
                    return Faculty::whereId($row->faculty_id)->first()->name;
                })
                ->addColumn('action', function($row){
                    $btn = '
                    <a href="'.route('admin.programmes.edit',['id'=>$row->id]).'" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i></a>
                     <a  class="px-3 text-danger sa-warning" id ="exam'.$row->id.'" data-exam="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Delete"  ><i class="uil uil-trash-alt font-size-18"></i></a>
                   ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('programme.index');
    }

    public function add(){
        $faculties = Faculty::get();
        return view('programme.add-edit',['faculties'=>$faculties,'types'=>config('app.programme_type')]);
    }
    public function edit($id) {
        $faculties = Faculty::get();
        $programme = Programme::whereId($id)->first();
        return view('programme.add-edit',['programme'=>$programme,'faculties'=>$faculties,'types'=>config('app.programme_type')]);
    }
    public function addEditProcess(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type'=>'required',
            'abbreviation' => 'sometimes|required|unique:programmes,abbreviation,'.$request['id'],
            'duration' => 'required|int|max:6|min:1'
        ]);
        $success=$warning=null;
        $isUpdate = false;
        if ($request['id']) {
            $programme = Programme::whereid($request['id'])->first();
            $isUpdate = true;
        }
        else{
            $programme = new Programme();
        }
        $programme->name = $request['name'];
        $programme->abbreviation = $request['abbreviation'];
        $programme->faculty_id = $request['faculty_id'];
        $programme->type = $request['type'];
        $programme->duration = $request['duration'];
        try{
            if ($isUpdate && $programme->update()) {
                $msag_type = 'success';
                $message =  $programme->name . ' successfully updated';
            } else{
                $programme->save();
                $msag_type = 'success';
                $message = $programme->name. ' successfully created';
            }
        }
        catch (QueryException $exception){
                $message = $exception;
                $msag_type = 'error';
            }
        return redirect()->route('admin.programmes.index')->with(['message_type'=>$msag_type,'message'=>$message]);
    }
    public function delete($id){
        $exam = Programme::whereId($id)->first();
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
