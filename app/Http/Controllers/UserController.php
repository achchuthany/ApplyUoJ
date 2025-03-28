<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = User::latest();
           return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    if($row->is_active){
                        return 'Active';
                    }
                    return 'Suspended';
                })
               ->addColumn('update', function($row){
                   return $row->updated_at->toDateTimeString();
               })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('users.edit',['id'=>$row->id]).'" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i></a>
                     <a  class="px-3 text-danger sa-warning" id ="exam'.$row->id.'" data-exam="'.$row->id.'" data-toggle="tooltip" data-placement="top" title="Delete Examination"  ><i class="uil uil-trash-alt font-size-18"></i></a>
               ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
     return view('user.index');
    }
    public function add(){
        if(auth()->user()->id!=1){
            $message = "System generated supper admin can add new user";
            return redirect()->back()->with(['warning'=>$message]);
        }

        $roles = Role::get();
        $faculties = Faculty::orderby('name','asc')->get();
        return view('user.add-edit',['roles'=>$roles,'faculties'=>$faculties]);
    }
    public function edit($id) {
        if($id==1 && auth()->user()->id!=1){
            $message = "System generated supper admin can edit";
            return redirect()->back()->with(['warning'=>$message]);
        }
        $user = User::where('id',$id)->first();
        $roles = Role::get();
        $userroles = $user->roles()->first();
        if($userroles->name == 'Student')
            $did =  $user->students()->first()->enrolls()->first()->programme()->first()->faculty_id;
        else if ($userroles->name == 'Admin'){
            $did = 0;
        }else{
            $did =  DB::table('role_user')->where([['user_id',$user->id],['role_id',$userroles->id]])->first()->faculty_id;
        }
        $faculties = Faculty::orderby('name','asc')->get();
        return view('user.add-edit',['did'=>$did,'userroles'=>$userroles,'user'=>$user,'roles'=>$roles,'faculties'=>$faculties]);

    }
    public function addEditProcess(Request $request)
    {

        $success=$warning=null;

        $isUpdate = false;
        if ($request['id']) {
            $user = User::where('id', $request['id'])->first();
            $isUpdate = true;
        }
        else{
           $user = new User();
        }

        $isEmail = strtolower($user->email) != strtolower($request['email']);
        $isNewPhone = ($user->phone_number) != ($request['phone_number']);

        $user->name = $request['name'];
        if($request['password']!=null)
            $user->password = Hash::make($request['password']);
        $user->is_active = $request['is_active'];
        $user->is_email_subscribed = $request['is_email_subscribed'] =='true';
        $user->is_sms_subscribed = $request['is_sms_subscribed']=='true';

        try{
            $student = $user->students()->first();
            if($student){
                $this->validate($request,[
                    'email' => 'sometimes|required|unique:students,email,'.$student->id,
                    'phone_number' => 'required|numeric|digits:13|unique:users,phone_number,'.$user->id

                ]);
                $student->email = $request['email'];
                $student->mobile = $request['phone_number'];
                $student->update();
            }

            if($isUpdate)
            {
                if($isEmail){
                    $user->email = strtolower($request['email']);
                    $user->email_verified_at = null;
                }

                if($isNewPhone){
                    $user->phone_number = $request['phone_number'];
                    $user->phone_verified_at = null;
                }
                $user->update();
                $role = DB::table('role_user')->where('user_id',$user->id);
                $x = DB::table('role_user')
                    ->where('id',$role->first()->id)
                    ->update([
                        'role_id'=>$request['role_id'],
                        'faculty_id'=>$request['faculty_id']
                    ]);
                if($isEmail){
                    event(new Registered($user));
                }
                $msag_type = 'success';
                $message = $user->name." user data has been successfully updated";
            }else{
                $this->validate($request,[
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['sometimes','required', 'string', 'email', 'max:255', 'unique:users'],
                    'phone_number' => ['required', 'numeric','digits:13','unique:users'],
                    'password' => ['required', 'string', 'min:8'],
                ]);
                $user->email = strtolower($request['email']);
                $user->phone_number = $request['phone_number'];
                $user->save();
                $x = DB::table('role_user')
                    ->insert([
                        'role_id'=>$request['role_id'],
                        'faculty_id'=>$request['faculty_id'],
                        'user_id'=>$user->id
                    ]);
                event(new Registered($user));
                $message = $user->name." user data has been successfully created";
                $msag_type = 'success';
            }
        }catch(QueryException $ex){
            $msag_type = 'error';
            $message = $ex->getMessage();
        }
        return redirect()->back()->with(['message_type'=>$msag_type,'message'=>$message]);
    }
    public function delete($id){
        $user= User::where('id',$id)->first();
        $role = DB::table('role_user')->where('user_id',$user->id);
        if($user->id == 1){
            $code = 201;
            $msg = 'System generated supper admin can not be delete.';
            return response()->json(['msg'=>$msg,'code'=>$code]);
        }
        try{
            $user->delete();
            $role->delete();
            $code = 200;
            $msg = $user->name;
        }catch (QueryException $ex){
            $msg = $ex->getMessage();
            $code = 201;
        }
        return response()->json(['msg'=>$msg,'code'=>$code]);
    }
    public function profile(){
        if(Auth::user()->hasRole('Admin')){

        }else if(Auth::user()->hasRole('Student')){
            return redirect()->route('student.profile.index');
        }

    }
    public function studentProfile(){
        $user = Student::select('users.email','students.mobile')->leftjoin('users','users.profile_id','=','students.id')->where('users.id',Auth::user()->id)->first();
        return view('user.profile',['user'=>$user]);
    }
    public function studentProfileProcess(Request $request)
    {
        $this->validate($request,[
            'email' => ['required', 'email', 'min:4'],
            'mobile' => ['required', 'regex:/[0-9]{10}/'],
        ]);

        $user=User::where('id',Auth::user()->id)->first();


        $student = Student::where('id',$user->profile_id)->first();
        $student->email = $request['email'];
        $student->mobile = $request['mobile'];
        try{
            $student->update();
                if($user->email != $request['email']){
                    $user->email = $request['email'];
                    $user->email_verified_at = null;
                    event(new Registered($user));
                }
                $user->update();
                $message = $user->name." user data has been successfully updated.";
                $msag_type = 'success';


        }catch(QueryException $ex){
            $msag_type = 'error';
            $message = $ex->getMessage();
        }
        return redirect()->back()->with(['message_type'=>$msag_type,'message'=>$message]);
    }

    public function reset(Request $request){
        if(!Auth::user()){
            return redirect()->route('home');
        }
        $user = User::whereId(Auth::user()->id)->first();
        DB::table('role_user')->where('user_id',$user->id)->delete();
        DB::table('user_student')->where('user_id',$user->id)->delete();
        $user->delete();

        return redirect('/register')->with(['success'=>'Your previews signup details has been deleted. Start you new registration here']);
    }

    public function roles(Request $request)
    {
        $this->validate($request,[
            'role_name' => ['required'],
            'role_description' => ['required'],
        ]);
        $role = new Role();
        $role->name = $request['role_name'];
        $role->description = $request['role_description'];
        $role->save();

        $message = " Role has been successfully created";
        $msag_type = 'success';
        return redirect()->back()->with(['message_type'=>$msag_type,'message'=>$message]);
    }
}
