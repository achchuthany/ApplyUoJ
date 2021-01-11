@extends('layouts.master-dark-sidebar')
@section('title')
Change Registration Number
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Enroll @endslot
    @slot('title') <a href="{{route('admin.students.enroll.profile',['id'=>$enroll->id])}}"> <i class="uil uil-arrow-left "></i> </a>  Registration Number @endslot
@endcomponent
    <div class="row">
    <div class="col-md-3  mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-title text-info">Profile Image</div>

                <div class="text-center">
                    @if($enroll->student->student_docs()->where('type','photo')->first() && Storage::disk('docs')->exists($enroll->student->student_docs()->where('type','photo')->first()->name))
                        <a class="image-popup-no-margins mb-0" href="/registration/student/image/{{$enroll->student->student_docs()->where('type','photo')->first()->name}}">

                            <img src="/registration/student/image/{{$enroll->student->student_docs()->where('type','photo')->first()->name}}" alt="{{$enroll->student->student_docs()->where('type','photo')->first()->type}}" class="img-fluid h-100 img-thumbnail mb-0">
                        </a>
                    @else
                        <img class="img-fluid h-100 img-thumbnail" alt="" src="{{ URL::asset('assets/images/users/user.png')}}" width="75">
                    @endif
                        <h6 class="mt-3 mb-1 text-capitalize">{{$enroll->student->name_initials}}</h6>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="card-title text-info">Current Enrolled Course <span class="text-muted font-size-12 float-right">Updated at {{$enroll->updated_at->diffForHumans()}} </span> </div>
                <div class="text-muted">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mt-4">
                                <p class="text-muted mb-1">Title</p>
                                <h5 class="font-size-16">{{$enroll->student->title}}</h5>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="mt-4">
                                <p class="text-muted mb-1">Full Name</p>
                                <h5 class="font-size-16">{{$enroll->student->full_name}}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-4">
                                <p class="text-muted mb-1">National Identity Card (NIC)</p>
                                <h5 class="font-size-16">{{$enroll->student->nic}}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mt-4">
                                <p class="text-muted mb-1">Mobile</p>
                                <h5 class="font-size-16">{{$enroll->student->mobile}}</h5>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <p class="mb-1">Faculty</p>
                            <h5 class="font-size-16">{{$enroll->programme->faculty->name}}</h5>
                        </div>
                        <div class="col-md-6 mt-4">
                            <p class="mb-1">Course of Study</p>
                            <h5 class="font-size-16">{{$enroll->programme->name}}</h5>
                        </div>
                        <div class="col-md-3 mt-4">
                            <p class="mb-1">Academic Year</p>
                            <h5 class="font-size-16">{{$enroll->academic_year->name}}</h5>
                        </div>
                        <div class="col-md-3 mt-4">
                            <p class="mb-1">Registration Number</p>
                            <h5 class="font-size-16 {{$enroll->reg_no? '': 'text-info'}} ">{{$enroll->reg_no? $enroll->reg_no: 'Not Assigned'}} </h5>
                        </div>

                        <div class="mt-4 col-md-3">
                            <p class="mb-1">Index Number</p>
                            <h5 class="font-size-16 {{$enroll->index_no? '': 'text-info'}} ">{{$enroll->index_no? $enroll->index_no: 'Not Assigned'}}</h5>
                        </div>

                        <div class="mt-4 col-md-3">
                            <p class="mb-1">Date of Registration</p>
                            <h5 class="font-size-16 {{$enroll->registration_date? '': 'text-info'}} ">{{$enroll->registration_date? Carbon\Carbon::parse($enroll->registration_date)->toFormattedDateString(): 'Not Assigned'}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card h-100 bg-soft-warning">
            <div class="card-header bg-warning text-light">Do you want to change the registration number? This process <b>cannot</b> be undone.</div>
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ route('admin.enroll.change.reg.process',['id'=>$enroll->id]) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Date of Registration</label>
                                <input id="date" value="{{$enroll->registration_date}}" name="date" type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group d-inline">
                                <label for="reg_no">Registration Number</label>
                                <input id="reg_no" name="reg_no" value="{{$enroll->reg_no}}" type="text" class="text-uppercase form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group d-inline">
                                <label for="index_no">Index Number</label>
                                <input id="index_no" name="index_no" value="{{$enroll->index_no}}" type="text" class="text-uppercase form-control">
                            </div>
                        </div>
                        <div class="col-md-3 mt-4">
                            <button  type="submit" class="btn btn-primary btn-block"> <i class="mdi mdi-account-edit-outline mr-1"></i> Change </button>
                        </div> <!-- end col -->
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
    </script>
    {{--    sweetalert--}}
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        var message = "{{Session::get('message')}}";
        var message_type = "{{Session::get('message_type')}}";
    </script>
    <script src="{{ URL::asset('assets/js/pages/sweetalert.index.js')}}"></script>
@endsection

