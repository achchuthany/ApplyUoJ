<?php

namespace App\Http\Controllers;

use App\Jobs\EnrolmentAcceptJob;
use App\Models\AcademicYear;
use App\Models\Address;
use App\Models\ApplicationRegistration;
use App\Models\CsvData;
use App\Models\Enroll;
use App\Models\Programme;
use App\Models\Student;
use App\Models\StudentAlExam;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public $params,$al_subjects,$grade,$countries;
    public $race;
    public $gender;
    public $civil_status;
    public $religion ,$districts;
    public function __construct(){
        $this->params = config('app.enroll_status');
        $this->countries = config('app.countries');
        $this->al_subjects = config('app.al_subjects');
        $this->grade = config('app.grades');
        $this->race = config('app.race');
        $this->gender = config('app.gender');
        $this->civil_status = config('app.civil_status');
        $this->religion = config('app.religion');
        $this->districts = config('app.districts');

    }
    public function index(){
        if(Auth::User()->hasRole('Dean')) {
        return redirect()->route('home.faculty')->with(['info'=>'You are redirected to faculty home']);
        }
        $ugc_count = Student::get()->count();
        $pending_count = Enroll::where('status','Processing')->get()->count();
        $pending_today_count = Enroll::whereDate('updated_at', Carbon::today())->where('status','Processing')->get()->count();

        $registered_count = Enroll::where('status','Registered')->get()->count();
        $registered_today_count = Enroll::whereDate('updated_at', Carbon::today())->where('status','Registered')->get()->count();



        $count_total = array();
        $count_today = array();
        foreach ($this->params as $key=>$value){
            $count_today[$key] = Enroll::whereDate('updated_at', Carbon::today())->where('status',$value)->get()->count();
            $count_total[$key]= Enroll::where('status',$value)->get()->count();
        }

        return view('student.index',[
            'count'=>[
                'ugc'=>$ugc_count,
                'pending'=>$pending_count,
                'pending_today'=>$pending_today_count,
                'registered'=>$registered_count,
                'registered_today'=>$registered_today_count
            ],
            'count_total'=>$count_total,
            'count_today'=>$count_today,
            'params'=>$this->params
        ]);
    }
    public function upload()
    {
        $programmes = Programme::get();
        $academics = AcademicYear::get();

        return view('student.upload',['programmes'=>$programmes,'academics'=>$academics]);
    }
    public function parseImport(Request $request)
    {
        $this->validate($request,[
            'csv_file'=>'required|file|mimes:csv,txt',
            'programme_id'=>'required',
            'academic_year_id'=>'required'
        ]);

        $checkApplication = ApplicationRegistration::where([['academic_year_id',$request['academic_year_id'],['programme_id',$request['academic_year_id']]]])->first();
        if(!$checkApplication){
            return redirect()->back()
                ->withInput()
                ->with(['warning'=>'Please create Registration Application in (Registrations >  Call a Registration) then upload data here!']);
        }

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $csv_data = array_slice($data, 1);
        $csv_header = array_slice($data, 0, 1);

        if($csv_header[0] != config('app.student_ugc_header') ) {
            $warning = 'Check your CSV file header data!!!';
            return redirect()->back()->with(['error'=>$warning]);
        }
        $csv_data_file = CsvData::create([
            'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
            'csv_header' => $request->has('header'),
            'csv_data' => json_encode($data)
        ]);
        return redirect()->route('admin.students.upload.view',[
            'pid'=>$request['programme_id'],
            'aid'=>$request['academic_year_id'],
            'id'=>$csv_data_file->id]);
    }
    public function uploadPreview($pid,$aid,$id){
        $csv_data_file= CsvData::whereId($id)->first();
        $csv_x = json_decode($csv_data_file->csv_data, true);

        $csv_data_x = array_slice($csv_x, 1);
        $csv_header = array_slice($csv_x, 0, 1);

        $programme = Programme::whereId($pid)->first();
        $academic = AcademicYear::whereId($aid)->first();


        //Validate Data

        //16 place is NIC number
        $csv_data = array();
        $i = 1;
        foreach ($csv_data_x as $row){

            //validate data
            //DATA
            $data = array();
            $data['application_year'] = $row[0];
            $data['al_index_number']= $row[1];
            $data['title']= $row[2];
            $data['name_initials']= $row[3];
            $data['full_name']= $row[4];
            $data['al_z_score']= $row[5];
            $data['district_no']= $row[6];
            $data['district']= $row[7];
            $data['race']= $row[8];
            $data['gender']= $row[9];
            $data['medium']= $row[10];

            $data['address_no']= $row[11];
            $data['address_street']= $row[12];
            $data['address_city']= $row[13];
            $data['address_4']= $row[14];

            $data['mobile']= $row[15];
            $data['nic']= $row[16];
            $data['al_english_mark']= $row[17];
            $data['email']= $row[18];
            $data['mobile_home']= $row[19];
            $data['parent_mobile']= $row[20];
            $data['parent_landline']= $row[21];

            $validator = Validator::make($data, [
                'application_year'=>'required|integer',
                'al_index_number'=>'required|integer|unique:students',
                'title'=>'max:20',
                'name_initials'=>'max:255',
                'full_name'=>'max:255',
                'al_z_score'=>'required|numeric|between:-4.00,4.00',
                'district_no'=>'required|integer|between:1,25',
                'district'=>'max:255',
                'race'=>'max:20' ,
                'gender'=>'max:10',
                'medium'=>'max:10',
                'address_no' =>'max:255',
                'address_street'=>'max:255',
                'address_city'=>'max:255',
                'address_4'=>'max:255' ,
                'mobile'=>'numeric',
                'nic'=>'required|unique:students',
                'al_english_mark'=>'required|numeric|between:0,100.00',
                'email'=>'email',
                'mobile_home'=>'numeric',
                'parent_mobile'=>'numeric',
                'parent_landline'=>'numeric'

            ]);
            $i++;

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with(['warning'=>'Your CSV file contain invalid data type in row #'.$i.' for student nic '.$row[16]]);
            }

            $s = Student::where('nic',$row[16])->first();
            if($s)
                array_unshift($row , 'Update');
            else
                array_unshift($row , 'New');

            $csv_data[] = $row;
        }
        return view('student.upload-view',compact('csv_data','csv_data_file','csv_header','programme','academic'));
    }
    public function processImport(Request $request)
    {
        $programme_id = $request['programme_id'];
        $academic_year_id = $request['academic_year_id'];

        $data = CsvData::find($request->csv_data_file_id);
        $csv_x = json_decode($data->csv_data, true);

        $csv_data = array_slice($csv_x, 1);
        $csv_header = array_slice($csv_x, 0, 1);
        $count_insert[0] = $count_update[0]= $count_insert[1] = $count_update[1]= 0;

        foreach ($csv_data as $row) {
            $enroll = new Enroll();
            $student = new Student();
            $address = new Address();

            //DATA
            $application_year = $row[0];
            $al_index_number= $row[1];
            $title= $row[2];
            $name_initials= $row[3];
            $full_name= $row[4];
            $al_z_score= $row[5];
            $district_no= $row[6];
            $district= $row[7];
            $race= $row[8];
            $gender= $row[9];
            $medium= $row[10];

            $address_no= $row[11];
            $address_street= $row[12];
            $address_city= $row[13];
            $address_4= $row[14];

            $mobile= $row[15];
            $nic= $row[16];
            $al_english_mark= $row[17];
            $email= $row[18];
            $mobile_home= $row[19];
            $parent_mobile= $row[20];
            $parent_landline= $row[21];


            $student->application_year = $application_year;
            $student->al_index_number = $al_index_number;
            $student->title = $title;
            $student->name_initials = $name_initials;
            $student->full_name = $full_name;
            $student->al_z_score = $al_z_score;
            $student->district_no = $district_no;
            $student->district = array_key_exists($district_no,$this->districts)?$this->districts[$district_no]:null;
            $student->race = $race;
            $student->gender = $gender;
            $student->medium = $medium;
            $student->district_no = $district_no;
            $student->mobile = $mobile;
            $student->nic = $nic;
            $student->al_english_mark = $al_english_mark;
            $student->email = $email;
            $student->mobile_home = $mobile_home;
            $student->parent_mobile = $parent_mobile;
            $student->parent_landline = $parent_landline;
            $student->created_by_user_id = Auth::user()->id;

            try{
                $student->save();
                $count_insert[0] += 1;
            }catch(QueryException $ex){
                $msag_type = 'error';
                $message = $ex->getMessage();
                return redirect()->route('admin.students.upload')->with(['message_type'=>$msag_type,'message'=>$message]);
            }

            //Add Address

            $address->address_no = $address_no;
            $address->address_street = $address_street;
            $address->address_city = $address_city;
            $address->address_4 = $address_4;
            $address->student_id = $student->id;
            $address->save();

            //Enroll
            $enroll->programme_id = $programme_id;
            $enroll->student_id = $student->id;
            $enroll->academic_year_id = $academic_year_id;

            try{
                $count_insert[1] +=1;
                $enroll->save();
            }catch(QueryException $ex){
                $msag_type = 'error';
                $message = $ex->getMessage();
                return redirect()->route('admin.students.upload')->with(['message_type'=>$msag_type,'message'=>$message]);
            }
            $msag_type = 'success';
            $message = $count_insert[0]. ' students and '.$count_insert[1].'  enroll data has been successfully created.';
        }
        return redirect()->route('admin.students.upload')->with(['message_type'=>$msag_type,'message'=>$message]);
    }
    public function all(Request $request){
        if ($request->ajax()) {
            if(Auth::User()->hasRole('Dean')){
                $user_id = auth()->user()->id;
                $faculty_id = DB::table('role_user')->where('user_id', $user_id)->value('faculty_id');
                $data= Enroll::select(
                    'enrolls.id as id',
                    'enrolls.programme_id as programme_id',
                    'enrolls.student_id as student_id',
                    'enrolls.academic_year_id as academic_year_id',
                    'enrolls.reg_no as reg_no',
                    'enrolls.index_no as index_no',
                    'enrolls.registration_date as registration_date',
                    'enrolls.status as status',
                    'enrolls.created_at as created_at',
                    'enrolls.updated_at as updated_at'
                )->leftJoin('programmes','programmes.id','=','enrolls.programme_id')->where([['programmes.faculty_id',$faculty_id]])->get();
            }else{
                $data = Enroll::latest()->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $doc = $row->student->student_docs()->where('type','photo')->first();
                    if($doc && Storage::disk('docs')->exists($doc->name))
                        return '<img src="/registration/student/image/'.$doc->name.'" alt="" class="avatar-sm  rounded-circle img-thumbnail">';
                    else if($row->student->gender == "M")
                        return '<img src="'.URL::asset('assets/images/users/male.png').'" alt="" class="avatar-sm  rounded-circle img-thumbnail">';
                    else
                        return '<img src="'.URL::asset('assets/images/users/female.png').'" alt="" class="avatar-sm  rounded-circle img-thumbnail">';


                })
                ->addColumn('name', function($row){
                    return $row->student->full_name;
                })
                ->addColumn('ref_no', function($row){
                    return $row->getRefNo();
                })
                ->addColumn('nic', function($row){
                    return Student::where('id',$row->student_id)->first()->nic;
                })
                ->addColumn('mobile', function($row){
                    return Student::where('id',$row->student_id)->first()->mobile;
                })
                ->addColumn('programme', function($row){
                    return $row->programme->name;
                })
                ->addColumn('academic_year', function($row){
                    return $row->academic_year->name;
                })
                ->addColumn('action', function($row){
                    $btn = '
                   <a href="'.route('admin.students.enroll.profile',['id'=>$row->id]).'" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="Profile"><i class="uil uil-user  "></i></a>
                   <a href="'.route('admin.students.edit',['sid'=>$row->student_id]).'" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="uil  uil-edit-alt  font-size-18"></i></a>
                   ';
                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('student.all');
    }
    public function pending(Request $request,$status){

        if(!array_key_exists("$status",$this->params)){
            return redirect()->route('admin.students.index');
        }
        if ($request->ajax()) {
            if(Auth::User()->hasRole('Dean')){
                $user_id = auth()->user()->id;
                $faculty_id = DB::table('role_user')->where('user_id', $user_id)->value('faculty_id');
                $data= Enroll::select(
                    'enrolls.id as id',
                    'enrolls.programme_id as programme_id',
                    'enrolls.student_id as student_id',
                    'enrolls.academic_year_id as academic_year_id',
                    'enrolls.reg_no as reg_no',
                    'enrolls.index_no as index_no',
                    'enrolls.registration_date as registration_date',
                    'enrolls.status as status',
                    'enrolls.created_at as created_at',
                    'enrolls.updated_at as updated_at'
                )->leftJoin('programmes','programmes.id','=','enrolls.programme_id')->where([['programmes.faculty_id',$faculty_id],['enrolls.status',$this->params[$status]]])->get();
            }else{
                $data = Enroll::where('status',$this->params[$status])->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $doc = $row->student->student_docs()->where('type','photo')->first();
                    if($doc && Storage::disk('docs')->exists($doc->name))
                        return '<img src="/registration/student/image/'.$doc->name.'" alt="" class="avatar-sm  rounded-circle img-thumbnail">';
                    else if($row->student->gender == "M")
                        return '<img src="'.URL::asset('assets/images/users/male.png').'" alt="" class="avatar-sm  rounded-circle img-thumbnail">';
                    else
                        return '<img src="'.URL::asset('assets/images/users/female.png').'" alt="" class="avatar-sm  rounded-circle img-thumbnail">';
                })
                ->addColumn('ref_no', function($row){
                    return $row->getRefNo();
                })
                ->addColumn('name', function($row){
                    return $row->student->name_initials;
                })
                ->addColumn('nic', function($row){
                    return Student::where('id',$row->student_id)->first()->nic;
                })
                ->addColumn('mobile', function($row){
                    return Student::where('id',$row->student_id)->first()->mobile;
                })
                ->addColumn('programme', function($row){
                    return $row->programme->name;
                })
                ->addColumn('academic_year', function($row){
                    return $row->academic_year->name;
                })
                ->addColumn('updated', function($row){
                    return $row->updated_at->toDateString() ." - ".$row->updated_at->longAbsoluteDiffForHumans();
                })
                ->addColumn('action', function($row){
                    $btn = '
                   <a href="'.route('admin.students.enroll.profile',['id'=>$row->id]).'" class="px-3 text-primary" data-toggle="tooltip" data-placement="top" title="View Submission"><i class="uil uil-user"></i></a>
                   ';
                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }
        return view('student.pending',['title'=>$this->params[$status]]);
    }
    public function student_profile(){
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();

        $races = config('app.race');
        $genders = config('app.gender');
        $civil_statuses = config('app.civil_status');
        $religion = config('app.religion');

        if(!$enroll)
            return redirect()->back();

        if($enroll->student->race && strlen($enroll->student->race)>1){
            $race = $enroll->student->race;
        }else if($enroll->student->race){
            $race = $races[$enroll->student->race];
        }else{
            $race = null;
        }
        $gender = $enroll->student->gender?$genders[$enroll->student->gender] : null;
        $civil_status = $enroll->student->civil_status? $civil_statuses[$enroll->student->civil_status] : null;

        $religion = $enroll->student->religion? (strlen($enroll->student->religion)>1?$enroll->student->religion:$religion[$enroll->student->religion]): null;

        return view('student.my_profile',['enroll'=>$enroll,'race'=>$race,'gender'=>$gender,'civil_status'=>$civil_status,'religion'=>$religion]);
    }
    public function profile($id)
    {
        $races = config('app.race');
        $genders = config('app.gender');
        $civil_statuses = config('app.civil_status');
        $religion = config('app.religion');

        if(Auth::User()->hasRole('Dean')){
            $user_id = auth()->user()->id;
            $faculty_id = DB::table('role_user')->where('user_id', $user_id)->value('faculty_id');
            $data= Enroll::leftJoin('programmes','programmes.id','=','enrolls.programme_id')->where([['programmes.faculty_id',$faculty_id],['enrolls.id',$id]])->first();
            if(!$data)
                return redirect()->route('home.faculty')->with(['warning'=>'Faculty admin only have the privilege to access their students']);
        }

        $enroll = Enroll::whereId($id)->first();


        if(!$enroll)
            return redirect()->back();

        if($enroll->student->race && strlen($enroll->student->race)>1){
            $race = $enroll->student->race;
        }else if($enroll->student->race){
            $race = $races[$enroll->student->race];
        }else{
            $race = null;
        }

        $gender = $enroll->student->gender?$genders[$enroll->student->gender] : null;
        $civil_status = $enroll->student->civil_status? $civil_statuses[$enroll->student->civil_status] : null;

        $religion = $enroll->student->religion? (strlen($enroll->student->religion)>1?$enroll->student->religion:$religion[$enroll->student->religion]): null;

    return view('student.profile',['enroll'=>$enroll,'race'=>$race,'gender'=>$gender,'civil_status'=>$civil_status,'religion'=>$religion]);
    }
    public function students(Request $request,$pid,$aid,$status){
        if ($status == "all") {
            $data = Enroll::where([['programme_id', $pid], ['academic_year_id', $aid]])->latest()->get();
            $filter = "All";

        } else {
            if (!array_key_exists("$status", $this->params)) {
                return redirect()->route('admin.students.index');
            }
            $data = Enroll::where([['programme_id', $pid], ['academic_year_id', $aid], ['status', $this->params[$status]]])->latest()->get();
            $filter = $this->params[$status];
        }
        if(Auth::User()->hasRole('Dean')) {
            $user_id = auth()->user()->id;
            $faculty_id = DB::table('role_user')->where('user_id', $user_id)->value('faculty_id');
            $programmes = Programme::where([['faculty_id',$faculty_id],['id',$pid]])->orderBy('name','asc')->get();
            if(!$programmes) $data = Enroll::where('status','null')->get();
        }

        $count = $data->count();

        //count value of student enroll status
        $count_total = array();
        foreach ($this->params as $key=>$value){
            $count_total[$key]= Enroll::where([['programme_id', $pid], ['academic_year_id', $aid],['status',$value]])->get()->count();
        }

        if ($request->ajax()) {
            return (Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $doc = $row->student->student_docs()->where('type','photo')->first();
                    if($doc && Storage::disk('docs')->exists($doc->name))
                        return '<img src="/registration/student/image/'.$doc->name.'" alt="" class="avatar-sm rounded-circle img-thumbnail">';
                    else if($row->student->gender == "M")
                        return '<img src="'.URL::asset('assets/images/users/male.png').'" alt="" class="avatar-sm  rounded-circle img-thumbnail">';
                    else
                        return '<img src="'.URL::asset('assets/images/users/female.png').'" alt="" class="avatar-sm  rounded-circle img-thumbnail">';
                })
                ->addColumn('ref_no', function($row){
                    return $row->getRefNo();
                })
                ->addColumn('reg_no', function ($row) {
                    return ($row->reg_no)?$row->reg_no:'N/A';
                })
                ->addColumn('index_no', function ($row) {
                    return ($row->index_no)?$row->index_no:'N/A';
                })
                ->addColumn('nic', function ($row) {
                    return $row->student->nic;
                })
                ->addColumn('mobile', function ($row) {
                    return $row->student->mobile;
                })
                ->addColumn('email', function ($row) {
                    return $row->student->email;
                })
                ->addColumn('address', function ($row) {
                    $add =  $row->student->addresses()->where('address_type','Permanent')->first();
                    if($add){
                        $address = $add->address_no.', '.$add->address_street;
                        $address.=  $add->address_city ? (', '.$add->address_city) : '';
                        $address.= $add->address_4 ? ', '.$add->address_4:'';
                        $address.= $add->address_state ? ', '.$add->address_state:'';
                        $address.=', '.$add->address_country;
                        $address.= $add->address_postal_code? ', '.$add->address_postal_code:'';
                        return $address;
                    }
                    return null;
                })
                ->addColumn('title', function ($row) {
                    return strtoupper($row->student->title);
                })
                ->addColumn('name_initials', function ($row) {
                    return $row->student->name_initials;
                })
                ->addColumn('full_name', function ($row) {
                    return $row->student->full_name;
                })
                ->addColumn('registration_date', function ($row) {
                    return ($row->registration_date)?Carbon::parse($row->registration_date)->toFormattedDateString().' ('.Carbon::parse($row->registration_date)->diffForHumans().')':"Not Registered";
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                   <a href="' . route('admin.students.enroll.profile', ['id' => $row->id]) . '" class="px-3 btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="View Submission"><i class="uil uil-user "></i> Profile</a>
                   ';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    return $row->status;
                })
                ->rawColumns(['action', 'image'])
                ->make(true));
        }
        $programme = Programme::whereId($pid)->first();
        $ay = AcademicYear::whereId($aid)->first();
            return view('student.list',['programme'=>$programme,'academic' => $ay,'count'=>$count,'filter'=>$filter,'count_total'=>$count_total,'params'=>$this->params ]);

    }
    public function searchStudentsList(Request $request){
        $this->validate($request,[
           'academic_year_id'=>'required',
            'programme_id'=>'required',
            'status'=>'required',
        ]);
        return redirect()->route('admin.students.program.academic',[
            'pid'=>$request['programme_id'],
            'aid'=>$request['academic_year_id'],
            'status'=>$request['status']]);
    }
    public function search(){
        if(Auth::User()->hasRole('Dean')) {
            $user_id = auth()->user()->id;
            $faculty_id = DB::table('role_user')->where('user_id', $user_id)->value('faculty_id');
            $programmes = Programme::where('faculty_id',$faculty_id)->orderBy('name','asc')->get();
        }else{
            $programmes = Programme::orderBy('name','asc')->get();
        }
        $academics = AcademicYear::orderBy('name','asc')->get();
        return view('student.search',[
            'programmes'=>$programmes,
            'academics'=>$academics,
            'params'=>$this->params
        ]);
    }
    public function acceptRequest(Request $request,$eid,$status){
        $enroll = Enroll::whereId($eid)->first();
        if(!$enroll)
            return response()->json(['msg'=>"Enroll data not found!",'code'=>201]);
        if(!array_key_exists("$status",$this->params))
            return response()->json(['msg'=>"Status data not found!",'code'=>201]);
        $isUpdateCountReceive = ($this->params[$status]!=$enroll->status);
        $enroll->status = $this->params[$status];
        try{
            $enroll->update();
            $code = 200;
            $msg = $enroll->student->name_initials." enroll status has been updated to ".$enroll->status;
            $job = (new EnrolmentAcceptJob($enroll->id,$request['message']))
                ->delay(
                    now()->addSeconds(30)
                );
            dispatch($job);
        }catch (QueryException $ex){
            $msg = $ex->getMessage();
            $code = 201;
        }
        DB::beginTransaction();
        try {
            $application = ApplicationRegistration::where([['academic_year_id', $enroll->academic_year_id], ['programme_id', $enroll->programme_id]])->first();
                if($isUpdateCountReceive && $this->params[$status]=='Accepted')
                    $application->count_received += 1;
//                if($isUpdateCountReceive && $this->params[$status]=='Invited')
//                    $application->count_received -= 1;
            $application->update();
            DB::commit();
        }catch(QueryException $e){
            DB::rollBack();
        }
        return response()->json(['msg'=>$msg,'code'=>$code,'status'=>$enroll->status]);
    }
    public function add() {
        $programmes = Programme::orderBy('name','asc')->get();
        $ays = AcademicYear::orderBy('name','desc')->get();
        return view('student.add-edit',[
            'al_subjects'=>$this->al_subjects,
            'al_grades'=>$this->grade,
            'countries'=>$this->countries,
            'programmes'=>$programmes,
            'academics'=>$ays,
            'districts'=>$this->districts,
        ]);
    }
    public function addEditProcess(Request $request){
        Validator::extend('older_than_fifteen_year', function($attribute, $value, $parameters)
        {
            return \Carbon\Carbon::now()->diff(new Carbon($value))->y >= 15;
        });
        $this->validate($request,[
            'title'=>'required|max:10',
            'last_name'=>'required|max:150',
            'name_initials'=>'required|max:150',
            'full_name'=>'required|max:150',
            'province'=>'required',
            'district'=>'required',
            'mobile'=>'required',
            'nic'=>'required|unique:students,nic,'.$request['student_id'],
            'email'=>'required|email|unique:students,email,'.$request['student_id'],
            'al_index_number'=>'required|unique:students,al_index_number,'.$request['student_id'],
            'al_exam_year'=>'required',
            'race'=>'required',
            'gender'=>'required',
            'civil_status'=>'required',
            'religion'=>'required',
            'date_of_birth'=>'required|date|older_than_fifteen_year:15',
            'citizenship'=>'required',
            'parent_full_name'=>'required|max:200',
            'parent_occupation'=>'required|max:200',
            'parent_mobile'=>'required|max:20',
            'emergency_contact_name'=>'required|max:200',
            'emergency_contact_mobile'=>'required|max:20',
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

        //Student Data
        $isUpdateStudent = ($request['student_id'])? true:false;
        if($isUpdateStudent){
            $student = Student::whereId($request['student_id'])->first();
        }else{
            $student = new Student();
            $student->created_by_user_id  = Auth::user()->id;
            $this->validate($request,[
                'programme_id'=>'required',
                'academic_year_id'=>'required',
                'registration_date'=>'required'
            ]);
            $student->application_year = AcademicYear::whereId($request['academic_year_id'])->first()->application_year;
        }




        $student->title = $request['title'];
        $student->last_name = $request['last_name'];
        $student->name_initials = $request['name_initials'];
        $student->full_name = $request['full_name'];
        $student->province = $request['province'];

        $student->district = $this->districts[$request['district']];
        $student->district_no = $request['district_no'];
        $student->nic  = $request['nic'];
        $student->mobile = $request['mobile'];
        $student->email  = $request['email'];

        $student->al_index_number = $request['al_index_number'];
        $student->al_exam_year = $request['al_exam_year'];
        $student->al_z_score = $request['al_z_score'];
        $student->race=$request['race'];
        if($request['race']=='O')
            $student->race=$request['RaceSpecify'];

        $student->gender = $request['gender'];

        $student->civil_status = $request['civil_status'];
        $student->religion = $request['religion'];
        if($request['religion']=='O')
            $student->religion=$request['religionSpecify'];
        $student->date_of_birth = $request['date_of_birth'];
        $student->citizenship = $request['citizenship'];
        $student->citizenship_type = $request['citizenship_type'];

        $student->parent_full_name = $request['parent_full_name'];
        $student->parent_occupation = $request['parent_occupation'];
        $student->parent_address_work = $request['parent_address_work'];
        $student->parent_mobile = $request['parent_mobile'];
        $student->parent_landline = $request['parent_landline'];

        $student->emergency_contact_name = $request['emergency_contact_name'];
        $student->emergency_contact_mobile = $request['emergency_contact_mobile'];

        if($isUpdateStudent){
            $student->update();
        }else{
            $student->save();
        }

        //AL Exams
        $subjects = $student->student_al_exams()->first();
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

        //Address

        $address_p = $student->addresses()->where('address_type','Permanent')->first();
        $isUpdate_p = true;
        if(!$address_p) {
            $address_p = new Address();
            $isUpdate_p = false;
            $address_p->address_type = 'Permanent';
            $address_p->student_id = $student->id;
        }
        $address_p->address_no = $request['address']['P']['address_no'];
        $address_p->address_street = $request['address']['P']['address_street'];
        $address_p->address_city = $request['address']['P']['address_city'];
        $address_p->address_4 = $request['address']['P']['address_4'];
        $address_p->address_state = $request['address']['P']['address_state'];
        $address_p->address_country = $request['address']['P']['address_country'];
        $address_p->address_postal_code = $request['address']['P']['address_postal_code'];
        if($isUpdate_p)
            $address_p->update();
        else {
            $address_p->save();
        }


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


        //New Enroll
        if(!$isUpdateStudent){
            $enroll = new Enroll();
            $programme_id = $request['programme_id'];
            $academic_year_id = $request['academic_year_id'];

            $data = (new EnrollController)->getRegNo($programme_id,$academic_year_id);

            $reg_no = (json_decode($data->getContent(),true)['reg_no']);
            $index_no = (json_decode($data->getContent(),true)['index_no']);

            $enroll->programme_id = $programme_id;
            $enroll->academic_year_id = $academic_year_id;
            $enroll->reg_no = $reg_no;
            $enroll->index_no = $index_no;
            $enroll->student_id = $student->id;
            $enroll->status = 'Registered';
            $enroll->registration_date = $request['registration_date'];
            $enroll->save();
            DB::beginTransaction();
            $application = new ApplicationRegistration();
            $application->next_registration_number +=1;
            try{
                $application->update();
                DB::commit();
            }catch(QueryException $e){
                DB::rollBack();
            }
        }

        return redirect()->route('admin.students.edit',['sid'=>$student->id])->with(['success'=>'Student data has been updated!']);
    }
    public function edit($sid) {
        $programmes = Programme::orderBy('name','asc')->get();
        $ays = AcademicYear::orderBy('name','desc')->get();
        $student= Student::whereId($sid)->first();
        $address_p = $student->addresses()->where('address_type','Permanent')->first();
        $address_c = $student->addresses()->where('address_type','Contact')->first();
        $subjects = $student->student_al_exams()->get();
        $enroll = $student->enrolls()->latest()->first();
        $enrolls = $student->enrolls()->latest()->get();
        return view('student.add-edit',[
            'student'=>$student,
            'al_subjects'=>$this->al_subjects,
            'al_grades'=>$this->grade,
            'countries'=>$this->countries,
            'programmes'=>$programmes,
            'academics'=>$ays,
            'districts'=>$this->districts,
            'address_p'=>$address_p,
            'address_c'=>$address_c,
            'subjects'=>$subjects,
            'enroll'=>$enroll,
            'enrolls'=>$enrolls
        ]);
    }
    public function delete(Request $request){
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return Datatables::of($data)
                ->addColumn('name', function($row){
                    return $row->name_initials;
                })
                ->addColumn('nic', function($row){
                    return $row->nic;
                })
                ->addColumn('mobile', function($row){
                    return $row->mobile;
                })
                ->addColumn('enrolls', function($row){
                    return $row->enrolls()->count();
                })
                ->addColumn('updated', function($row){
                    return $row->updated_at;
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="custom-control custom-checkbox mb-2 mr-sm-3">';
                    if($row->enrolls()->where('status','<>','Invited')->count()>0)
                        $btn.='<i class="mdi mdi-lock text-success font-size-16" data-toggle="tooltip" data-placement="top" title="Cannot remove student "></i>';
                    else
                        $btn.='
                                <input type="checkbox" id="'.$row->id.'" name="delete[]" value="'.$row->id.'" class="custom-control-input">
                                <label class="custom-control-label" for="'.$row->id.'">
                                    <i class="mdi mdi-account-remove text-danger font-size-16" data-toggle="tooltip" data-placement="top" title="Delete"></i></label>';
                        $btn.='</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('student.delete');
    }
    public function deleteProcess(Request $request) {

        $stu_ids = $request['delete'];

        if(!$stu_ids)
            return redirect()->back()->with(['warning'=>'Select the students']);
        $a=$b=0;
        foreach ($stu_ids as $id){
            try{
                $student  = Student::whereId($id)->first();
                if($student->enrolls()->where('status','<>','Invited')->count()<1) {
                    $enrolls = $student->enrolls()->delete();
                    $address = $student->addresses()->delete();
                    $users = $student->users()->delete();
                    $al = $student->student_al_exams()->delete();
                    $student_docs = $student->student_docs()->delete();
                    $student->delete();
                    $a++;
                }else{
                    $b++;
                }
                $code = 200;
                $msg = 'Students record was deleted. (Number of record : '.$a.')';
            }catch (QueryException $ex){
                $msg = $ex->getMessage();
                $code = 201;
            }
        }
    return redirect()->back()->with(['success'=>$msg]);
}
}
