<?php

namespace App\Http\Controllers;

use App\Jobs\RegistrationConfirmationJob;
use App\Models\Address;
use App\Models\ApplicationRegistration;
use App\Models\Enroll;
use App\Models\Student;
use App\Models\StudentAlExam;
use App\Models\StudentDoc;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public $countries;
    public $al_subjects ;
    public $grade;
    public $race;
    public $gender;
    public $civil_status;
    public $religion ;
    public function __construct(){
        $this->countries = config('app.countries');
        $this->al_subjects = config('app.al_subjects');
        $this->grade = config('app.grades');
        $this->race = config('app.race');
        $this->gender = config('app.gender');
        $this->civil_status = config('app.civil_status');
        $this->religion = config('app.religion');
    }
    public function index(){
        if($this->checkApplicationStatus())
            return redirect()->route('student.registration.completed');
        return redirect()->route('student.personal');
    }
    public function personal(){
        if($this->checkApplicationStatus())
            return redirect()->route('student.registration.completed');
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();
        return view('registration.index',['student'=>$student,'enroll'=>$enroll]);
    }
    public function personalProcess(Request $request){
        $this->validate($request,[
           'title'=>'required|max:10',
           'last_name'=>'required|max:150'
        ]);
        $id = Auth::user()->students()->latest()->first()->id;
        $student = Student::whereId($id)->first();
        $student->title = $request['title'];
        $student->last_name = $request['last_name'];
        try {
            $student->update();
            return redirect()->route('student.address');
        }catch (QueryException $e){
            return back()->withInput()->with(['error'=>'Failed to update']);
        }
    }
    public function address(){
        if($this->checkApplicationStatus())
            return redirect()->route('student.registration.completed');
        $student = Auth::user()->students()->latest()->first();
        if(!$student->last_name)
            return redirect()->route('student.personal');
        $address_p = $student->addresses()->where('address_type','Permanent')->first();
        $address_c = $student->addresses()->where('address_type','Contact')->first();
        return view('registration.index',['student'=>$student,'address_p'=>$address_p,'address_c'=>$address_c,'countries'=>$this->countries]);
    }
    public function addressProcess(Request $request){
        $this->validate($request,[
            'province'=>'required',
            'mobile'=>'required',
            'email'=>'required',
        ]);

        $validator = Validator::make($request['address']['P'],[
            'address_no'=>'required|max:150',
            'address_street'=>'required|max:150',
            'address_country'=>'required|max:150'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validator = Validator::make($request['address']['C'],[
            'address_no'=>'required|max:150',
            'address_street'=>'required|max:150',
            'address_country'=>'required|max:150'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $student = Auth::user()->students()->latest()->first();

        $address_p = $student->addresses()->where('address_type','Permanent')->first();
        $address_p->address_no = $request['address']['P']['address_no'];
        $address_p->address_street = $request['address']['P']['address_street'];
        $address_p->address_city = $request['address']['P']['address_city'];
        $address_p->address_4 = $request['address']['P']['address_4'];
        $address_p->address_state = $request['address']['P']['address_state'];
        $address_p->address_country = $request['address']['P']['address_country'];
        $address_p->address_postal_code = $request['address']['P']['address_postal_code'];
        $address_p->update();


        $address_C = $student->addresses()->where('address_type','Contact')->first();
        $isUpdate = true;
        if(!$address_C) {
            $address_C = new Address();
            $isUpdate = false;
            $address_C->address_type = 'Contact';
            $address_C->student_id = $student->id;
        }
        $address_C->address_no = $request['address']['C']['address_no'];
        $address_C->address_street = $request['address']['C']['address_street'];
        $address_C->address_city = $request['address']['C']['address_city'];
        $address_C->address_4 = $request['address']['C']['address_4'];
        $address_C->address_state = $request['address']['C']['address_state'];
        $address_C->address_country = $request['address']['C']['address_country'];
        $address_C->address_postal_code = $request['address']['C']['address_postal_code'];
        if($isUpdate)
            $address_C->update();
        else {
            $address_C->save();
        }

        $student->province = $request['province'];
        $student->mobile = $request['mobile'];
        $student->email  = $request['email'];

        $user = $student->users()->latest()->first();
        if($user && strtolower($user->email) != strtolower($request['email'])){
            $user->email = $request['email'];
            $user->email_verified_at = null;
            $user->update();
            event(new Registered($user));
        }

        $student->update();
        return redirect()->route('student.education');

    }
    public function education(){
        if($this->checkApplicationStatus())
            return redirect()->route('student.registration.completed');
        $student = Auth::user()->students()->latest()->first();
        $subjects = $student->student_al_exams()->get();
        if(!$student->province)
            return redirect()->route('student.address');
        return view('registration.index',['student'=>$student,'al_subjects'=>$this->al_subjects,'al_grades'=>$this->grade,'subjects'=>$subjects]);
    }
    public function educationProcess(Request $request){
        $this->validate($request,[
            'al_exam_year'=>'required'
        ]);
        $validator = Validator::make($request['subjects'][1],[
            'subject'=>'required',
            'grade'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $validator = Validator::make($request['subjects'][2],[
            'subject'=>'required',
            'grade'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $validator = Validator::make($request['subjects'][3],[
            'subject'=>'required',
            'grade'=>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $student = Auth::user()->students()->latest()->first();
        $student->al_exam_year = $request['al_exam_year'];
        $student->update();
        $subjects = $student->student_al_exams()->first();
        $isUpdate = true;
        if($subjects){
            $subjects = $student->student_al_exams()->delete();
        }
        foreach ($request['subjects'] as $subject){
            $sub = new StudentAlExam();
            $sub->student_id = $student->id;
            $sub->subject = $subject['subject'];
            $sub->grade = $subject['grade'];
            $sub->save();
        }
        return redirect()->route('student.citizenship');
    }
    public function citizenship(){
        if($this->checkApplicationStatus())
            return redirect()->route('student.registration.completed');
        $student = Auth::user()->students()->latest()->first();
        return view('registration.index',['student'=>$student,'countries'=>$this->countries]);
    }
    public function citizenshipProcess(Request $request){
        Validator::extend('older_than_fifteen_year', function($attribute, $value, $parameters)
        {
            return Carbon::now()->diff(new Carbon($value))->y >= 15;
        });
        $this->validate($request,[
            'race'=>'required',
            'gender'=>'required',
            'civil_status'=>'required',
            'religion'=>'required',
            'date_of_birth'=>'required|date|older_than_fifteen_year:15',
            'citizenship'=>'required',
        ]);

        $student = Auth::user()->students()->latest()->first();
        $student->race=$request['race'];
        if($request['race']=='O')
            $student->race=$request['RaceSpecify'];
        $student->gender=$request['gender'];
        $student->civil_status=$request['civil_status'];
        $student->religion=$request['religion'];
        if($request['religion']=='O')
            $student->religion=$request['religionSpecify'];
        $student->date_of_birth=$request['date_of_birth'];
        $student->citizenship=$request['citizenship'];
        $student->citizenship_type=$request['citizenship_type'];
        $student->update();
        return redirect()->route('student.parents');
    }
    public function parents(){
       if($this->checkApplicationStatus())
           return redirect()->route('student.registration.completed');
        $student = Auth::user()->students()->latest()->first();
        if(!$student->date_of_birth)
            return redirect()->route('student.citizenship');

        return view('registration.index',['student'=>$student]);
    }
    public function parentsProcess(Request $request){
        $student = Auth::user()->students()->latest()->first();
        $this->validate($request,[
            'parent_full_name'=>'required|max:250',
            'parent_occupation'=>'required|max:250',
            'parent_mobile'=>'required|max:20',
            'emergency_contact_name'=>'required|max:250',
            'emergency_contact_mobile'=>'required|max:20',
        ]);
        $student->parent_full_name = $request['parent_full_name'];
        $student->parent_occupation = $request['parent_occupation'];
        $student->parent_mobile = $request['parent_mobile'];
        $student->emergency_contact_name = $request['emergency_contact_name'];
        $student->emergency_contact_mobile = $request['emergency_contact_mobile'];
        $student->parent_address_work = $request['parent_address_work'];

        $enroll = $student->enrolls()->latest()->first();
        $enroll->status = 'Documents Pending';
        try {
            $student->update();
            $enroll->update();
            return redirect()->route('student.documents');
        }catch (QueryException $e){
            return back()->withInput()->with(['error'=>'Failed to update']);
        }
    }
    public function documents(){
        if($this->checkApplicationStatus())
            return redirect()->route('student.registration.completed');
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();
        if(!$student->emergency_contact_mobile)
            return redirect()->route('student.parents');

        return view('registration.index',['enroll'=>$enroll]);
    }
    public function complete(){
        if($this->checkApplicationStatus())
            return redirect()->route('student.registration.completed');
        return view('registration.conform');
    }
    public function completeProcess(){
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();
        if($enroll->status!='Documents Pending'){
            return redirect()->route('student.registration.completed');
        }
        $enroll->status = 'Processing';
        $enroll->update();
        dispatch(new RegistrationConfirmationJob($enroll->id,$student->id));
        return redirect()->route('student.registration.completed');
    }
    public function completed(){
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();
        if(!$this->checkApplicationStatus())
            return redirect()->route('student.registration.complete');
        return view('registration.proceed',['enroll'=>$enroll]);
    }
    public function downloadPersonalData($eid){

        $enroll = Enroll::whereId($eid)->first();
        $student= $enroll->student;
        $permanent =  $student->addresses->where('address_type','Permanent')->first();
        $permanentAddress = $permanent->address_no .' '.$permanent->address_street .' '.$permanent->address_city .' '.$permanent->address_4 .' '.$permanent->address_state .' '.$permanent->address_country .' '.$permanent->address_postal_code ;
        $permanent =  $student->addresses->where('address_type','Contact')->first();
        $contactAddress =$permanent ? $permanent->address_no .' '.$permanent->address_street .' '.$permanent->address_city .' '.$permanent->address_4 .' '.$permanent->address_state .' '.$permanent->address_country .' '.$permanent->address_postal_code :null ;
        $student_al_exams = $student->student_al_exams()->get();
        if(strlen($student->race)>1){
            $race = $student->race;
        }else{
            $race = $student->race? $this->race[$student->race] : null;
        }

        if(strlen($student->religion)>1){
            $religion = $student->religion;
        }else{
            $religion = $student->religion ? $this->religion[$student->religion]: null;
        }

        $data = [
            'student'=>$student,
            'enroll'=>$enroll,
            'NotAssigned'=>'Not Assigned',
            'permanentAddress'=>$permanentAddress,
            'contactAddress'=>$contactAddress,
            'student_al_exams'=>$student_al_exams,
            'race'=>$race,
            'gender'=>$student->gender? $this->gender[$student->gender]:null,
            'civil_status'=>$student->civil_status?$this->civil_status[$student->civil_status]:null,
            'religion'=>$religion,
            'dob'=>Carbon::parse($student->date_of_birth)->toFormattedDateString(),
            'age'=>Carbon::now()->diffInYears(Carbon::parse($enroll->student->date_of_birth)),
        ];
        $dompdf = PDF::loadView('pdf.personal_data',$data);
        $dompdf->setPaper('A4', 'portrait');
        //return $dompdf->stream();
        return $dompdf->download($student->nic.'_Personal_Data.pdf');
    }
    public function checkApplicationStatus(){
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();
        if($enroll->status=='Invited'||$enroll->status=='Documents Pending'){
            return false;
        }
        return true;
    }
    public function imageUploadPost(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg|max:2048',
            'bank' => 'required|image|mimes:jpeg,jpg|max:2048',
            'lc_f' => 'required|image|mimes:jpeg,jpg|max:2048',
            'lc_b' => 'required|image|mimes:jpeg,jpg|max:2048',
            'nic_f' => 'required|image|mimes:jpeg,jpg|max:2048',
            'nic_b' => 'required|image|mimes:jpeg,jpg|max:2048',
        ]);
        $student = Auth::user()->students()->latest()->first();


        $imageName =$student->nic.'_photo.'.$request->image->extension();
        $request->image->storeAs('docs', $imageName);
        /* Store $imageName name in DATABASE from HERE */
        $docs = StudentDoc::where([['student_id',$student->id],['type','photo']])->first();
        $isUpdate = true;
        if(!$docs){
            $docs = new StudentDoc();
            $isUpdate = false;
        }

        $docs->student_id = $student->id;
        $docs->name = $imageName;
        $docs->type = "photo";
        if($isUpdate)
            $docs->update();
        else
            $docs->save();



        //bank
        $imageName =$student->nic.'_bank.'.$request->bank->extension();
        $request->bank->storeAs('docs', $imageName);
        /* Store $imageName name in DATABASE from HERE */
        $docs = StudentDoc::where([['student_id',$student->id],['type','bank']])->first();
        $isUpdate = true;
        if(!$docs){
            $docs = new StudentDoc();
            $isUpdate = false;
        }

        $docs->student_id = $student->id;
        $docs->name = $imageName;
        $docs->type = "bank";
        if($isUpdate)
            $docs->update();
        else
            $docs->save();

        //LC Front

        $imageName =$student->nic.'_FLC.'.$request->lc_f->extension();
        $request->lc_f->storeAs('docs', $imageName);
        /* Store $imageName name in DATABASE from HERE */
        $docs = StudentDoc::where([['student_id',$student->id],['type','FLC']])->first();
        $isUpdate = true;
        if(!$docs){
            $docs = new StudentDoc();
            $isUpdate = false;
        }

        $docs->student_id = $student->id;
        $docs->name = $imageName;
        $docs->type = "FLC";
        if($isUpdate)
            $docs->update();
        else
            $docs->save();

        //LC Back
        $imageName =$student->nic.'_BLC.'.$request->lc_b->extension();
        $request->lc_b->storeAs('docs', $imageName);
        /* Store $imageName name in DATABASE from HERE */
        $docs = StudentDoc::where([['student_id',$student->id],['type','BLC']])->first();
        $isUpdate = true;
        if(!$docs){
            $docs = new StudentDoc();
            $isUpdate = false;
        }

        $docs->student_id = $student->id;
        $docs->name = $imageName;
        $docs->type = "BLC";
        if($isUpdate)
            $docs->update();
        else
            $docs->save();

        //NIC Front
        $imageName =$student->nic.'_FNIC.'.$request->nic_f->extension();
        $request->nic_f->storeAs('docs', $imageName);
        /* Store $imageName name in DATABASE from HERE */
        $docs = StudentDoc::where([['student_id',$student->id],['type','FNIC']])->first();
        $isUpdate = true;
        if(!$docs){
            $docs = new StudentDoc();
            $isUpdate = false;
        }

        $docs->student_id = $student->id;
        $docs->name = $imageName;
        $docs->type = "FNIC";
        if($isUpdate)
            $docs->update();
        else
            $docs->save();

        //NIC Back
        $imageName =$student->nic.'_BNIC.'.$request->nic_b->extension();
        $request->nic_b->storeAs('docs', $imageName);
        /* Store $imageName name in DATABASE from HERE */
        $docs = StudentDoc::where([['student_id',$student->id],['type','BNIC']])->first();
        $isUpdate = true;
        if(!$docs){
            $docs = new StudentDoc();
            $isUpdate = false;
        }

        $docs->student_id = $student->id;
        $docs->name = $imageName;
        $docs->type = "BNIC";
        if($isUpdate)
            $docs->update();
        else
            $docs->save();


        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }
    public function getImageFile($name){
        $path= Storage::disk('docs')->path($name);
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
