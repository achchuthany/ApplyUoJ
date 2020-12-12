<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        return view('home');
    }

    public function pdf(){
        //return view('pdf.personal_data');
        $dompdf = PDF::loadView('pdf.personal_data');
        $dompdf->setPaper('A4', 'portrait');


// Output the generated PDF to Browser
        return $dompdf->stream();

    }
}
