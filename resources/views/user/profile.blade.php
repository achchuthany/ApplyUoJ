@extends('layouts.master-color-sidebar')
@section('title')
    Student Profile
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') MACOSIS @endslot
        @slot('title') Profile @endslot
    @endcomponent

    <div class="row align-content-center">
        <div class="col-xl-6 offset-md-3">
            <div class="card">
                <div class="card-header font-size-18">
                   Edit Profile
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div>
                            @if(Storage::disk('public')->exists('images/users/'.Auth::user()->username.'.jpeg'))
                                <img src="{{ Storage::url('images/users/'.Auth::user()->username.'.jpeg') }}" alt="" class="avatar-lg  rounded-circle img-thumbnail">
                            @else
                                <img src="{{URL::asset('assets/images/users/avatar-1.jpg') }}" alt="" class="avatar-lg  rounded-circle img-thumbnail">
                            @endif


                                    <div class="m-1">
                                        <a class="btn-link" href="{{route('student.image.upload')}}">Upload Profile Picture</a>
                                    </div>

                        </div>
                    </div>
                    <div class="text-muted">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block text-center">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your data.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('student.profile.process') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 mt-2">
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input value="{{(isset($user)&&!Request::old('email'))? $user->email : Request::old('email')}}"  id="email" name="email" type="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mt-2">
                                            <div class="form-group">
                                                <label class="control-label">Mobile Phone</label>
                                                <input value="{{(isset($user)&&!Request::old('mobile'))? $user->mobile : Request::old('mobile')}}"  id="mobile" name="mobile" type="text" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-12 mt-2">

                                        </div>
                                        <div class="col-md-3 col-sm-12 mt-2">
                                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-primary">
                    <div> <i class="fa fa-info-circle"></i> The mobile format is ten numbers (0-9).</div>
                    <div> <i class="fa fa-info-circle"></i> If you update your email, please verify your email address. Check your email inbox to further instructions. </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->

@endsection
@section('script')
    {{--    sweetalert--}}
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        var message = "{{Session::get('message')}}";
        var message_type = "{{Session::get('message_type')}}";
    </script>
    <script src="{{ URL::asset('assets/js/pages/sweetalert.index.js')}}"></script>
@endsection
