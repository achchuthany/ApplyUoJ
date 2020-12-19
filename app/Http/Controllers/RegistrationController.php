<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\ApplicationRegistration;
use App\Models\Student;
use App\Models\StudentAlExam;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public $countries = array(
    'Afghanistan',
    'Albania',
    'Algeria',
    'American Samoa',
    'Andorra',
    'Angola',
    'Anguilla',
    'Antarctica',
    'Antigua and Barbuda',
    'Argentina',
    'Armenia',
    'Aruba',
    'Australia',
    'Austria',
    'Azerbaijan',
    'Bahamas',
    'Bahrain',
    'Bangladesh',
    'Barbados',
    'Belarus',
    'Belgium',
    'Belize',
    'Benin',
    'Bermuda',
    'Bhutan',
    'Bolivia',
    'Bosnia and Herzegowina',
    'Botswana',
    'Bouvet Island',
    'Brazil',
    'British Indian Ocean Territory',
    'Brunei Darussalam',
    'Bulgaria',
    'Burkina Faso',
    'Burundi',
    'Cambodia',
    'Cameroon',
    'Canada',
    'Cape Verde',
    'Cayman Islands',
    'Central African Republic',
    'Chad',
    'Chile',
    'China',
    'Christmas Island',
    'Cocos (Keeling) Islands',
    'Colombia',
    'Comoros',
    'Congo',
    'Congo, the Democratic Republic of the',
    'Cook Islands',
    'Costa Rica',
    'Cote d\'Ivoire',
    'Croatia (Hrvatska)',
    'Cuba',
    'Cyprus',
    'Czech Republic',
    'Denmark',
    'Djibouti',
    'Dominica',
    'Dominican Republic',
    'East Timor',
    'Ecuador',
    'Egypt',
    'El Salvador',
    'Equatorial Guinea',
    'Eritrea',
    'Estonia',
    'Ethiopia',
    'Falkland Islands (Malvinas)',
    'Faroe Islands',
    'Fiji',
    'Finland',
    'France',
    'France Metropolitan',
    'French Guiana',
    'French Polynesia',
    'French Southern Territories',
    'Gabon',
    'Gambia',
    'Georgia',
    'Germany',
    'Ghana',
    'Gibraltar',
    'Greece',
    'Greenland',
    'Grenada',
    'Guadeloupe',
    'Guam',
    'Guatemala',
    'Guinea',
    'Guinea-Bissau',
    'Guyana',
    'Haiti',
    'Heard and Mc Donald Islands',
    'Holy See (Vatican City State)',
    'Honduras',
    'Hong Kong',
    'Hungary',
    'Iceland',
    'India',
    'Indonesia',
    'Iran (Islamic Republic of)',
    'Iraq',
    'Ireland',
    'Israel',
    'Italy',
    'Jamaica',
    'Japan',
    'Jordan',
    'Kazakhstan',
    'Kenya',
    'Kiribati',
    'Korea, Democratic People\'s Republic of',
    'Korea, Republic of',
    'Kuwait',
    'Kyrgyzstan',
    'Lao, People\'s Democratic Republic',
    'Latvia',
    'Lebanon',
    'Lesotho',
    'Liberia',
    'Libyan Arab Jamahiriya',
    'Liechtenstein',
    'Lithuania',
    'Luxembourg',
    'Macau',
    'Macedonia, The Former Yugoslav Republic of',
    'Madagascar',
    'Malawi',
    'Malaysia',
    'Maldives',
    'Mali',
    'Malta',
    'Marshall Islands',
    'Martinique',
    'Mauritania',
    'Mauritius',
    'Mayotte',
    'Mexico',
    'Micronesia, Federated States of',
    'Moldova, Republic of',
    'Monaco',
    'Mongolia',
    'Montserrat',
    'Morocco',
    'Mozambique',
    'Myanmar',
    'Namibia',
    'Nauru',
    'Nepal',
    'Netherlands',
    'Netherlands Antilles',
    'New Caledonia',
    'New Zealand',
    'Nicaragua',
    'Niger',
    'Nigeria',
    'Niue',
    'Norfolk Island',
    'Northern Mariana Islands',
    'Norway',
    'Oman',
    'Pakistan',
    'Palau',
    'Panama',
    'Papua New Guinea',
    'Paraguay',
    'Peru',
    'Philippines',
    'Pitcairn',
    'Poland',
    'Portugal',
    'Puerto Rico',
    'Qatar',
    'Reunion',
    'Romania',
    'Russian Federation',
    'Rwanda',
    'Saint Kitts and Nevis',
    'Saint Lucia',
    'Saint Vincent and the Grenadines',
    'Samoa',
    'San Marino',
    'Sao Tome and Principe',
    'Saudi Arabia',
    'Senegal',
    'Seychelles',
    'Sierra Leone',
    'Singapore',
    'Slovakia (Slovak Republic)',
    'Slovenia',
    'Solomon Islands',
    'Somalia',
    'South Africa',
    'South Georgia and the South Sandwich Islands',
    'Spain',
    'Sri Lanka',
    'St. Helena',
    'St. Pierre and Miquelon',
    'Sudan',
    'Suriname',
    'Svalbard and Jan Mayen Islands',
    'Swaziland',
    'Sweden',
    'Switzerland',
    'Syrian Arab Republic',
    'Taiwan, Province of China',
    'Tajikistan',
    'Tanzania, United Republic of',
    'Thailand',
    'Togo',
    'Tokelau',
    'Tonga',
    'Trinidad and Tobago',
    'Tunisia',
    'Turkey',
    'Turkmenistan',
    'Turks and Caicos Islands',
    'Tuvalu',
    'Uganda',
    'Ukraine',
    'United Arab Emirates',
    'United Kingdom',
    'United States',
    'United States Minor Outlying Islands',
    'Uruguay',
    'Uzbekistan',
    'Vanuatu',
    'Venezuela',
    'Vietnam',
    'Virgin Islands (British)',
    'Virgin Islands (U.S.)',
    'Wallis and Futuna Islands',
    'Western Sahara',
    'Yemen',
    'Yugoslavia',
    'Zambia',
    'Zimbabwe'
    );

    public $al_subjects = array(
        'Physics'=>'Physics (01)',
        'Chemistry'=>'Chemistry (02)',
        'Mathematics'=>'Mathematics (07)',
        'Agricultural Science'=>'Agricultural Science (08)',
        'Biology'=>'Biology (09)',
        'Combined Mathematics'=>'Combined Mathematics (10)',
        'Higher Mathematics'=>'Higher Mathematics (11)',
        'Common General Test'=>'Common General Test (12)',
        'General English'=>'General English (13)',
        'Civil Technology'=>'Civil Technology (14)',
        'Mechanical Technology'=>'Mechanical Technology (15)',
        'Electrical, Electronic and Information Technology'=>'Electrical, Electronic and Information Technology (16)',
        'Food Technology'=>'Food Technology (17)',
        'Agriculture Technology'=>'Agriculture Technology (18)',
        'Bio Resource Technology'=>'Bio Resource Technology (19)',
        'Information & Communication Technology'=>'Information & Communication Technology (20)',
        'Economics'=>'Economics (21)',
        'Geography'=>'Geography (22)',
        'Political Science'=>'Political Science (23)',
        'Logic and Scientific Method'=>'Logic and Scientific Method (24)',
        'History of Sri Lanka'=>'History of Sri Lanka (25)',
        'History of India'=>'History of India (25A)',
        'History of Europe'=>'History of Europe (25B)',
        'Modern World History'=>'Modern World History (25C)',
        'Home Economics'=>'Home Economics (28)',
        'Communication & Media Studies'=>'Communication & Media Studies (29)',
        'Business Statistics'=>'Business Statistics (31)',
        'Business Studies'=>'Business Studies (32)',
        'Accountancy'=>'Accountancy (33)',
        'Buddhism'=>'Buddhism (41)',
        'Hinduism'=>'Hinduism (42)',
        'Christianity'=>'Christianity (43)',
        'Islam'=>'Islam (44)',
        'Buddhist Civilization'=>'Buddhist Civilization (45)',
        'Hindu Civilization'=>'Hindu Civilization (46)',
        'Islam Civilization'=>'Islam Civilization (47)',
        'Greek and Roman Civilization'=>'Greek and Roman Civilization (48)',
        'Christian Civilization'=>'Christian Civilization (49)',
        'Art (51)'=>'Art (51)',
        'Dancing (Indigenous)'=>'Dancing (Indigenous) (52)',
        'Dancing (Bharatha)'=>'Dancing (Bharatha) (53)',
        'Music (Oriental)'=>'Music (Oriental) (54)',
        'Music (Carnatic)'=>'Music (Carnatic) (55)',
        'Music (Western)'=>'Music (Western) (56)',
        'Drama and Theatre (Sinhala)'=>'Drama and Theatre (Sinhala) (57)',
        'Drama and Theatre (Tamil)'=>'Drama and Theatre (Tamil) (58)',
        'Drama and Theatre (English)'=>'Drama and Theatre (English) (59)',
        'Engineering Technology'=>'Engineering Technology (65)',
        'Biosystems Technology'=>'Biosystems Technology (66)',
        'Science for Technology'=>'Science for Technology (67)',
        'Sinhala'=>'Sinhala (71)',
        'Tamil'=>'Tamil (72)',
        'English'=>'English (73)',
        'Pali'=>'Pali (74)',
        'Sanskrit'=>'Sanskrit (75)',
        'Arabic'=>'Arabic (78)',
        'Malay'=>'Malay (79)',
        'French'=>'French (81)',
        'German'=>'German (82)',
        'Russian'=>'Russian (83)',
        'Hindi'=>'Hindi (84)',
        'Chinese'=>'Chinese (86)',
        'Japanese'=>'Japanese (87)'
    );

    public $grade  = array(
        'A'=>'Distinction Pass',
        'B'=>'Very Good Pass',
        'C'=>'Credit Pass',
        'S'=>'Ordinary Pass',
        'F'=>'Fail'
    );

    public $race = array(
        'S'=>'Sinhala',
        'T'=>'Tamil',
        'M'=>'Muslim'
    );
    public $gender = array(
        'M'=>'Male',
        'F'=>'Female'
    );
    public $civil_status = array(
        'S'=>'Single',
        'M'=>'Married'
    );
    public $religion = array(
        'B'=>'Buddhist',
        'H'=>'Hindu',
        'C'=>'Christian',
        'I'=>'Islam'
    );

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
           'title'=>'required',
           'last_name'=>'required'
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
        $student = Auth::user()->students()->latest()->first();
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
        try {
            $student->update();
            return redirect()->route('student.registration.complete');
        }catch (QueryException $e){
            return back()->withInput()->with(['error'=>'Failed to update']);
        }
    }
    public function complete(){
        if($this->checkApplicationStatus())
            return redirect()->route('student.registration.completed');
        return view('registration.conform');
    }
    public function completeProcess(){
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();
        if($enroll->status!='Invited'){
            return redirect()->route('student.registration.completed');
        }
        $enroll->status = 'Documents Pending';
        $enroll->update();
        DB::beginTransaction();
        try {
            $application = ApplicationRegistration::where([['academic_year_id', $enroll->academic_year_id], ['programme_id', $enroll->programme_id]])->first();
            $application->count_received += 1;
            $application->update();
            DB::commit();
        }catch(QueryException $e){
            DB::rollBack();
        }
        return redirect()->route('student.registration.completed');
    }
    public function completed(){
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();
        if(!$this->checkApplicationStatus())
            return redirect()->back();
        return view('registration.proceed',['enroll'=>$enroll]);
    }
    public function downloadPersonalData(){
        $student = Auth::user()->students()->latest()->first();
        $enroll = $student->enrolls()->latest()->first();
        $permanent =  $student->addresses->where('address_type','Permanent')->first();
        $permanentAddress = $permanent->address_no .' '.$permanent->address_street .' '.$permanent->address_city .' '.$permanent->address_4 .' '.$permanent->address_state .' '.$permanent->address_country .' '.$permanent->address_postal_code ;
        $permanent =  $student->addresses->where('address_type','Contact')->first();
        $contactAddress = $permanent->address_no .' '.$permanent->address_street .' '.$permanent->address_city .' '.$permanent->address_4 .' '.$permanent->address_state .' '.$permanent->address_country .' '.$permanent->address_postal_code ;
        $student_al_exams = $student->student_al_exams()->get();
        if(strlen($student->race)>1){
            $race = $student->race;
        }else{
            $race = $this->race[$student->race];
        }

        if(strlen($student->religion)>1){
            $religion = $student->religion;
        }else{
            $religion = $this->religion[$student->religion];
        }

        $data = [
            'student'=>$student,
            'enroll'=>$enroll,
            'NotAssigned'=>'Not Assigned',
            'permanentAddress'=>$permanentAddress,
            'contactAddress'=>$contactAddress,
            'student_al_exams'=>$student_al_exams,
            'race'=>$race,
            'gender'=>$this->gender[$student->gender],
            'civil_status'=>$this->civil_status[$student->civil_status],
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
        if($enroll->status!='Invited'){
            return true;
        }
        return false;
    }
}
