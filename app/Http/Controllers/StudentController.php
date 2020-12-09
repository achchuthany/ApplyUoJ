<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Address;
use App\Models\CsvData;
use App\Models\Enroll;
use App\Models\Programme;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(){
        $programmes = Programme::orderBy('name','asc')->get();
        $academics = AcademicYear::orderBy('name','asc')->get();
        return view('student.index',['programmes'=>$programmes,'academics'=>$academics]);
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
                'application_year'=>'required|int',
                'al_index_number'=>'required|int|unique:students',
                'title'=>'max:20',
                'name_initials'=>'max:255',
                'full_name'=>'max:255',
                'al_z_score'=>'required|numeric|between:0,4.00',
                'district_no'=>'required|int',
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
                    ->with(['warning'=>'Your CSV file coantain invalid data type in row #'.$i.' for student nic '.$row[16]]);
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
            $student->district = $district;
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

}
