@extends('layouts.master-topbar')
@section('title')
    Personal Data of Students
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Registration @endslot
        @slot('title')
            Personal Data of Students
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form class="needs-validation" method="POST" action="{{ route('student.registration.complete.process') }}">
                    {{ csrf_field() }}
               <div class="card-body text-center">
                   <p> Use the 'Proceed with Registration' button provided at the bottom of the page to complete your registration. </p>
                   <p>I understand that access to use this system is granted solely for the purpose of applying for study at the University of Jaffna, Sri Lanka.</p>
                   <div class="row mt-4">
                       <div class="col-md-6 text-right">
                           <a href="{{route('student.parents')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
                       </div>
                       <div class="col-md-6 text-left">
                           <button  type="submit" class="btn btn-primary">  Proceed with Registration <i class="mdi mdi-content-save mr-1"></i></button>
                       </div> <!-- end col -->
                   </div> <!-- end row-->
               </div>
                <div class="card-footer text-center">
                    <i class="mdi mdi-star text-warning"></i> This step can not be undone.
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

