@extends('layouts.master-without-nav')
@section('title')
    Online Application Form
@endsection
@section('content')
    <div class="container">
     <div class="row align-items-center vh-100">
        <div class="col-md-4 align-middle text-center">
            <div class="text-center">
                <a href="{{url('/')}}" class="mb-5 d-block auth-logo">
                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA" height="80" class="logo logo-dark">
                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA" height="80" class="logo logo-light">
                </a>
            </div>

        </div>
         <div class="col-md-8">
             <div class="p-2">
                 <div class="card shadow-none">
                     <div class="card-body">
                         <div class="font-size-20">
                             REGISTRATION OF STUDENTS FOR
                         </div>
                         <div class="h2  text-primary">
                             COURSES OF STUDY OF UNIVERSITY OF JAFFNA
                         </div>
                     </div>
                     <div class="card-header">
                         <i class="mdi mdi-information-outline text-light"></i>  Please read these instructions carefully before you complete the online application.
                     </div>
                     <div class="card-body">
                         <div class="text-justify ">
                            <p>  Online Application Form (available at www.jfn.ac.lk) should be filled only in the English medium using BLOCK CAPITAL LETTERS.</p>
                            <p> Full Name must be given as it is appeared in the Birth Certificate. (If the name in the Birth Certificate is different than the name which is in use, necessary amendments should be made in the Birth Certificate prior to get the registration)</p>
                            <p>  Please provide your permanent address, contact telephone number and email address to enable the Admission & Registration Branch of the University of Jaffna to communicate with you in future activities.</p>
                            <p> You should indicate your educational qualifications and examination results accurately and clearly.</p>
                            <p> You should complete all the entry requirements on or before the closing date.</p>
                         </div>
                     </div>
                     <div class="card-footer">
                         <a href="{{route('login')}}" class="btn btn-light"> My Applications</a>

                         <a href="{{route('register')}}" class="btn btn-primary ">Start the Registration Process <i class="mdi mdi-arrow-right-bold-box-outline"></i> </a>
                     </div>
                 </div>



             </div>
         </div>
    </div>
    </div>

@endsection
