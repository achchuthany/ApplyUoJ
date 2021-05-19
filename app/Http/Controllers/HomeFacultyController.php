<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Enroll;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeFacultyController extends Controller
{
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $params;

    public function __construct(){
        $this->params = config('app.enroll_status');
    }
    public function index(){
        $academic_year = AcademicYear::latest()->first()->id;
        if(!$academic_year) $academic_year = 0;
        return $this->indexData([$academic_year]);
    }

    public function indexSearch(Request $request){
        if(!$request['academic_years'])
            return redirect()->back()->with(['warning'=>'Select Academic Year']);
        return $this->indexData($request['academic_years']);
    }

    private function indexData($academic_years){
        $user_id = auth()->user()->id;
        $faculty_id = DB::table('role_user')->where('user_id', $user_id)->value('faculty_id');
        $faculty = 'All Faculties';
        if($faculty_id){
            $faculty = Faculty::whereId($faculty_id)->first()->name;
        }
        $ays = AcademicYear::latest()->get();
        $count_total = array();
        $count_today = array();
        foreach ($this->params as $key=>$value){
            $count_today[$key] = Enroll::leftJoin('programmes','programmes.id','=','enrolls.programme_id')->whereDate('enrolls.updated_at', Carbon::today())->where([['enrolls.status',$value],['programmes.faculty_id',$faculty_id]])->whereIn('enrolls.academic_year_id',$academic_years)->get()->count();
            $count_total[$key]= Enroll::leftJoin('programmes','programmes.id','=','enrolls.programme_id')->where([['enrolls.status',$value],['programmes.faculty_id',$faculty_id]])->whereIn('enrolls.academic_year_id',$academic_years)->get()->count();
        }
        $total= Enroll::leftJoin('programmes','programmes.id','=','enrolls.programme_id')->where([['programmes.faculty_id',$faculty_id]])->whereIn('enrolls.academic_year_id',$academic_years)->get()->count();

        return view('home_faculty',[
            'count_total'=>$count_total,
            'count_today'=>$count_today,
            'params'=>$this->params,
            'ays'=>$ays,
            'faculty'=>$faculty,
            'selected_ays'=>$academic_years,
            'total'=>$total
        ]);
    }
}
