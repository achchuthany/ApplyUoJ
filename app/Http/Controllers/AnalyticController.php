<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Enroll;
use App\Models\Programme;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    private $params,$races,$religion;

    public function __construct(){
        $this->params = config('app.enroll_status');
        $this->races = config('app.race');
        $this->religion = config('app.religion');

    }
    public function raceIndex(){
        $academic_years = AcademicYear::orderBy('name','desc')->get();
        $programmes = Programme::orderBy('name','desc')->get();
        $enroll_status = $this->params;
        return view('analytic.race',['academic_years'=>$academic_years,"programmes"=>$programmes,"enroll_status"=>$enroll_status]);

    }
    public function getRaceData(Request $request){
        $programme_ids = $request['programme_id'];
        $academic_year_ids = $request['academic_year_id'];
        $enroll_status = $request['enroll_status'];

        $enrolls = Enroll::leftJoin('students','students.id','=','enrolls.student_id')->whereIn('enrolls.programme_id',$programme_ids)->whereIn('enrolls.status',$enroll_status)->whereIn('academic_year_id',$academic_year_ids);

        $total = $enrolls->count();
        $race_count = [];
        $label = [];
        foreach ($this->races as $key=>$value){
            $race_count[] = Enroll::leftJoin('students','students.id','=','enrolls.student_id')
                ->whereIn('enrolls.programme_id',$programme_ids)
                ->whereIn('enrolls.status',$enroll_status)
                ->whereIn('academic_year_id',$academic_year_ids)
                ->where('race',"$key")
                ->count();
            $label[] = $value;
        }
        $others = $total - array_sum($race_count);
        $race_count[] = $others;
        $label[]="Others";

        $religion_count = [];
        $religion_label = [];
        foreach ($this->religion as $key=>$value){
            $religion_count[] = Enroll::leftJoin('students','students.id','=','enrolls.student_id')
                ->whereIn('enrolls.programme_id',$programme_ids)
                ->whereIn('enrolls.status',$enroll_status)
                ->whereIn('academic_year_id',$academic_year_ids)
                ->where('religion',"$key")
                ->count();
            $religion_label[] = $value;
        }
        $others = $total - array_sum($religion_count);
        $religion_count[] = $others;
        $religion_label[]="Others";

        return response()->json(['label'=>$label,'data'=>$race_count,"total"=>$total,'religion_count'=>$religion_count,'religion_label'=>$religion_label]);
    }
}