@extends('layouts.master-dark-sidebar')
@section('title')
    Confirmation of Enrolment
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Enroll @endslot
        @slot('title') <a href="{{route('admin.application.registrations.index')}}"> <i class="uil uil-arrow-left "></i> </a>  Confirmation of Enrolment @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted">
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <p class="mb-1">Faculty</p>
                                <h5 class="font-size-16">{{$application->programme->faculty->name}}</h5>
                            </div>
                            <div class="col-md-6 mt-4">
                                <p class="mb-1">Programme</p>
                                <h5 class="font-size-16">{{$application->programme->name}}</h5>
                            </div>
                            <div class="col-md-6 mt-4">
                                <p class="mb-1">Academic Year</p>
                                <h5 class="font-size-16">{{$application->academic_year->name}}</h5>
                            </div>
                            <div class="col-md-6 mt-4">
                                <p class="mb-1">Number of Registered Students</p>
                                <button type="button" class="btn btn-sm btn-outline-secondary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center"><span class="font-size-16">{{sprintf('%03d',$enrolls->count())}}</span></button>
                            </div>
                            <div class="col-md-6 mt-4">
                                <p class="mb-1">Academic Year</p>
                                <h5 class="font-size-16">{{$application->academic_year->name}}</h5>
                            </div>
                            <div class="col-md-6 mt-4">
                                <p class="mb-1">Action</p>
                                <form action="{{route('admin.enroll.confirmation.process',['app_id'=>$application->id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Sent</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-center" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Students</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                   @foreach($enrolls as $enroll)
                        <a class="btn btn-sm btn-outline-light m-1" href="{{route('admin.students.enroll.profile',['id'=>$enroll->id])}}"><span class="text-primary">{{$enroll->reg_no}}</span> {{$enroll->student->email}}</a>
                    @endforeach
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
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

