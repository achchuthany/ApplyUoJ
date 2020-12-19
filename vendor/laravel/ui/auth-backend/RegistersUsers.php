<?php

namespace Illuminate\Foundation\Auth;

use App\Models\ApplicationRegistration;
use App\Models\Role;
use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
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



        event(new Registered($user = $this->create($request->all())));
        $role_student = Role::where('name', 'Student')->first();
        $user->roles()->attach($role_student);
        $user->students()->attach($student);
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect()->route('student.registration.index');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
