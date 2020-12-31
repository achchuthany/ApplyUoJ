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

                <div class="text-uppercase h5 font-weight-bolder text-warning">
                    Web Application under <i class="mdi mdi-beta"></i>testing ..
                    <div class="spinner-grow text-warning m-1" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-md-8">
             <div class="">
                 <div class="card">
                     <div class="card-body">
                         <div class="font-size-18">
                             REGISTRATION OF STUDENTS FOR
                         </div>
                         <div class="h2  text-primary">
                             COURSES OF STUDY OF UNIVERSITY OF JAFFNA
                         </div>
                     </div>
                     <div class="card-body">
                         <div class="card-title">
                             <i class="mdi mdi-information-outline"></i>  Please read these instructions carefully before you complete the online application.
                         </div>
                         <div class="text-justify">
                            <p>  Online Application Form   should be filled only in the English medium using BLOCK CAPITAL LETTERS.</p>
                            <p> Full Name must be given as it is appeared in the Birth Certificate. (If the name in the Birth Certificate is different than the name which is in use, necessary amendments should be made in the Birth Certificate prior to get the registration)</p>
                            <p>  Please provide your permanent address, contact telephone number and email address to enable the Admission & Registration Branch of the University of Jaffna to communicate with you in future activities.</p>
                            <p> You should indicate your educational qualifications and examination results accurately and clearly.</p>
                             <p class="font-weight-bold">Before start this online registration, please keep the scan images (JPG/JPEG and Each image size < 5MB) of Your photo, NIC Front Side, NIC Back Side, School Leaving Certificate Front Side , School Leaving Certificate Back Side and Paid Voucher(Use this <a href="{{URL::asset('/assets/images/download/PAYING_IN_VOUCHER.pdf')}}" download="PAYING_IN_VOUCHER.pdf" target="_blank" class="btn btn-sm btn-link"><i class="mdi mdi-download-outline"></i> Paying in Voucher </a> for your total payments) </p>
                            <p> You should complete all the entry requirements on or before the closing date.</p>
                             <p>Use the <b>'Start the Registration Now!'</b> button provided at the bottom of the page to start your registration.</p>
                         </div>
                     </div>
                     <div class="card-footer bg-transparent text-right">
                         <a href="{{route('login')}}" class="btn btn-light mr-2"><i class="mdi mdi-account-outline"></i> My Applications</a>

                         <a href="{{route('register')}}" class="btn btn-primary "><i class="mdi mdi-progress-check"></i> Start the Registration Now!</a>
                     </div>
                 </div>
             </div>
         </div>
    </div>
    </div>

@endsection
