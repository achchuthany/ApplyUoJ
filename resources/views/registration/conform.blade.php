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
                <div class="card-header text-info">
                   <i class="fas fa-info-circle"></i> Use the 'Proceed with Registration' button provided at the bottom of the page to complete your registration. If you click 'Proceed with Registration' you will
                    no be able to Edit the application anymore.
                </div>
                <form class="needs-validation" method="POST" action="{{ route('student.registration.complete.process') }}">
                    {{ csrf_field() }}
               <div class="card-body">
                   <div class="custom-control custom-checkbox custom-control-inline">
                       <input value="ok" type="checkbox" id="Descent" name="citizenship_type" class="custom-control-input" required>
                       <label class="custom-control-label" for="Descent">I understand that access to use this system is granted solely for the purpose of applying for study at the University of Jaffna, Sri Lanka.</label>
                   </div>
                   <div class="row mt-4">
                       <div class="col-md-6 text-right">
                           <a href="{{route('student.documents')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
                       </div>
                       <div class="col-md-6 text-left">
                           <button  type="submit" class="btn btn-primary">  Proceed with Registration <i class="mdi mdi-content-save mr-1"></i></button>
                       </div> <!-- end col -->
                   </div> <!-- end row-->
               </div>
                </form>
            </div>
        </div>
    </div>

@endsection

