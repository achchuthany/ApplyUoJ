<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ApplicationRegistration;
use App\Models\Role;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nic' => ['required'],
            'al' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => strtoupper($data['nic']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $student = Student::where([['nic',strtoupper(trim($request['nic']))],['al_index_number',$request['al']]])->first();
        if(!$student)
            return back()->withInput()->with(['warning'=>'The Index Number is incorrect or you are not selected for university admission']);
        $enroll = $student->enrolls()->latest()->first();

        $application = ApplicationRegistration::where([['academic_year_id',$enroll->academic_year_id],['programme_id',$enroll->programme_id]])->first();

        if(!$application){
            return back()->with(['error'=>'Database Error: Requested application for the course is not in the database'])->withInput();
        }
        if(!$enroll){
            return back()->with(['error'=>'Database Error: The Student did not enroll to any course.'])->withInput();
        }
        $open_date = Carbon::parse($application->open_date);
        $close_date = Carbon::parse($application->close_date);
        $now = Carbon::now();
        $now->hour = 0;
        $now->minute = 0;
        $now->second = 0;

        if(!(($now->greaterThanOrEqualTo($open_date) && $now->lessThanOrEqualTo($close_date)) || $application->status=='Draft') ){
//            return response()->json([$now,$now->greaterThanOrEqualTo($open_date),$now->lessThanOrEqualTo($close_date)]);
            return back()->with(['info'=>'Application will be open soon/Please Contact Officials'])->withInput();
        }
        if($student->users()->get()->count()>0){
            return back()->with(['warning'=>'User already Exist with your data. If you are not created already please contact Officalis'])->withInput();
        }
        $user = $this->create($request->all());
        $role_student = Role::where('name', 'Student')->first();
        $user->roles()->attach($role_student);
        $user->students()->attach($student);
        $student->email = $user->email;
        $student->update();
        event(new Registered($user));
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->route('student.registration.index');
    }
}
