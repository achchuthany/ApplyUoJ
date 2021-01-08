<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Enroll;
use App\Models\Faculty;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(Auth::User()->roles()->get());
        if(Auth::User()->hasRole('Student')){
            return redirect()->route('student.registration.index');
        }else{
            $ays = AcademicYear::latest()->get();
           return view('home',['ays'=>$ays]);
        }
    }

    public function graphData($aid){
       $counts = DB::table('enrolls')
           ->select(DB::raw('count(*) as count,programmes.abbreviation,academic_years.name'))
           ->leftJoin('programmes','programmes.id','=','enrolls.programme_id')
           ->leftJoin('academic_years','academic_years.id','=','enrolls.academic_year_id')
           ->where([['enrolls.status','Registered'],['academic_years.id',$aid]])
           ->groupByRaw('programmes.abbreviation,academic_years.name')
           ->get();

        $programme = array();
        $students = array();

        foreach ($counts as $count){
            $programme [] = $count->abbreviation;
            $students [] = $count->count; //rand(10,100);
        }

        return response()->json(['programme'=>$programme,'count'=>$students]);
    }
}
