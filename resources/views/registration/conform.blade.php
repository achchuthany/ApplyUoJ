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
                <div class="card-header">
                   <span>Use the 'Proceed with Registration' button provided at the bottom of the page to complete your registration.
                    If you click 'Proceed with Registration' you will not be able to Edit the application anymore.</span>
                </div>
                <form class="needs-validation" method="POST" action="{{ route('student.registration.complete.process') }}">
                    {{ csrf_field() }}
               <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                           <p class="text-uppercase">Checklist of uploaded documents</p>
                       </div>
                       <div class="col-md-12">
                          <p><i class="mdi font-weight-bold font-size-24 {{$checkUpload['isProfileImage']?'mdi-check text-success':'mdi-close text-danger'}}"></i>
                              Your recent photograph (Identity Card Image) (Step 06)
                          </p>
                       </div>
                       <div class="col-md-12">
                           <p><i class="mdi font-weight-bold font-size-24 {{$checkUpload['isUGC']?'mdi-check text-success':'mdi-close text-danger'}}"></i>
                               Selection Letter sent by the UGC (Step 07)
                           </p>
                       </div>
                       <div class="col-md-12">
                           <p><i class="mdi font-weight-bold font-size-24 {{$checkUpload['isBank']?'mdi-check text-success':'mdi-close text-danger'}}"></i>
                               Paid Bank Voucher (Step 07)
                           </p>
                       </div>
                       <div class="col-md-12">
                           <p><i class="mdi font-weight-bold font-size-24 {{$checkUpload['isLC']?'mdi-check text-success':'mdi-close text-danger'}}"></i>
                               Student Record Sheet (School Leaving Certificate) (Step 07)
                           </p>
                       </div>
                       <div class="col-md-12">
                           <p><i class="mdi font-weight-bold font-size-24 {{$checkUpload['isNIC']?'mdi-check text-success':'mdi-close text-danger'}}"></i>
                               National Identity Card(NIC) / Passport (Step 07)
                           </p>
                       </div>
                       <div class="col-md-12">
                           <p class="text-dark">
                               Note:  If you find that any documents are not fully uploaded, please go back and upload the documents.
                           </p>
                       </div>
                   </div>
                   <div class="custom-control custom-checkbox custom-control-inline mt-3">
                       <input value="ok" type="checkbox" id="Descent" name="citizenship_type" class="custom-control-input" required>
                       <label class="custom-control-label" for="Descent">I hereby declare that the information given in previous pages is true and accurate to the best of my knowledge.</label>
                   </div>
                   <div class="row mt-4">
                       <div class="col-md-6 text-right">
                           <a href="{{route('student.documents')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
                       </div>
                       <div class="col-md-6 text-left">
                           <button  type="submit" class="btn btn-primary"><i class="mdi mdi-content-save-all mr-1"></i>  Proceed with Registration</button>
                       </div> <!-- end col -->
                   </div> <!-- end row-->
               </div>
                </form>
            </div>
        </div>
    </div>

@endsection

