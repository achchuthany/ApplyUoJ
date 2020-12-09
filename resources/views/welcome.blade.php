@extends('layouts.master-without-nav')
@section('title')
    Online Application Form
@endsection
@section('content')
    <div class="container">
     <div class="row align-items-center vh-100">
        <div class="col-md-4 align-middle">
            <div class="font-size-20 text-light">
                REGISTRATION OF STUDENTS FOR
            </div>
            <div class="h2  text-light">
                COURSES OF STUDY OF UNIVERSITY OF JAFFNA
            </div>
        </div>
         <div class="col-md-8">
             <div class="text-right">
                 <a href="{{url('/')}}" class="mb-5 d-block auth-logo">
                     <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA" height="100" class="logo logo-dark">
                     <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA" height="100" class="logo logo-light">
                 </a>
             </div>

             <div class="ml-5">
                 PLEASE READ THESE INSTRUCTIONS CAREFULLY BEFORE YOU COMPLETE THE ONLINE APPLICATION.

                 <a href="#" class="btn btn-primary text-uppercase">continue</a>
             </div>
         </div>
    </div>
    </div>

@endsection
