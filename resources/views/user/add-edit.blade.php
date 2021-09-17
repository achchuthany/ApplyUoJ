@extends('layouts.master-dark-sidebar')
@section('title')
Add New User
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Administration @endslot
    @slot('title') Add New User @endslot
@endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div id="addproduct-accordion" class="custom-accordion">
                <div class="card">
                    <a  class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                        <div class="p-4">
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-16 mb-1">User Info</h5>
                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div>
                        <div class="p-4 border-top">
                            <form class="needs-validation" method="POST" action="{{route('users.process')}}" novalidate>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Full Name</label>
                                            <input value="{{(isset($user)&&!Request::old('name'))? $user->name : Request::old('name')}}"  id="name" name="name" type="text" class="form-control {{isset($user)&& $user->hasRole('Student')?'bg-light':''}}" required {{isset($user)&& $user->hasRole('Student')?'readonly':''}}>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="faculty_id">Faculty</label>
                                            <select class="form-control select2 " name="faculty_id" required>
                                                <option disabled selected>Select Faculty</option>
                                                <option value="0" {{(isset($user)&&!Request::old('department_id'))? (($did  == '0')? 'selected':'') : ( (Request::old('department_id') =='0')? 'selected':'')}}>All Faculties</option>
                                                @foreach($faculties as $faculty)
                                                    <option value="{{$faculty->id}}" {{(isset($user)&&!Request::old('department_id'))? (($did  == $faculty->id)? 'selected':'') : ( (Request::old('department_id') ==$faculty->id)? 'selected':'')}}>{{$faculty->name}}</option>
                                                @endforeach
                                            </select><input id="id" class="form-control" type="hidden" name="id" value="{{ (isset($user))? $user->id   : ''}}" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="role_id">User Role</label>
                                            <select class="form-control select2" name="role_id" readonly>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" {{(isset($user)&&!Request::old('role_id'))? (($userroles->id  == $role->id)? 'selected':'') : ( (Request::old('role_id') ==$role->id)? 'selected':'')}} {{(isset($userroles) && $userroles->name  == "Admin" && $role->name!='Admin' && $user->id  == 1) ?'disabled':''}} {{(isset($userroles) && $userroles->name  == "Student" && $userroles->id  != $role->id) ?'disabled':''}} {{( isset($userroles) && $userroles->name  != "Student" &&  $role->name=="Student") ?'disabled':''}} {{!isset($user) && $role->name=="Student" ?'disabled':''}}>{{$role->description}}</option>
                                                @endforeach
                                            </select><input id="id" class="form-control" type="hidden" name="id" value="{{ (isset($user))? $user->id   : ''}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input value="{{(isset($user)&&!Request::old('email'))? $user->email : Request::old('email')}}"  id="email" name="email" type="email" class="form-control" required>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Phone Number</label>
                                            <input value="{{(isset($user)&&!Request::old('phone_number'))? $user->phone_number : Request::old('phone_number')}}"  id="phone_number" name="phone_number" type="text" class="form-control" required placeholder="0094770201500">

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input value="{{(isset($user)&&!Request::old('password'))? '' : Request::old('password')}}"  id="password" name="password" type="password" class="form-control" {{isset($user)? '':'required'}} placeholder="minimum 8 characters">

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Subscription</label>
                                            <div class="form-check">
                                                <input class="form-check-input" name="is_email_subscribed" type="checkbox" id="is_email_subscribed" value="true" {{(isset($user)&&$user->is_email_subscribed == true) ? 'checked':''}}>
                                                <label class="form-check-label" for="is_email_subscribed">
                                                    Email Subscription
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="is_sms_subscribed" name="is_sms_subscribed" value="true" {{(isset($user)&&$user->is_sms_subscribed == true) ? 'checked':''}}>
                                                <label class="form-check-label" for="is_sms_subscribed">
                                                    SMS Subscription
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Verification</label>
                                            <p class="my-0 {{isset($user)&&$user->email_verified_at?'text-success':'text-warning'}}">
                                                <i class="mdi mdi-email"></i> {{isset($user)?$user->email_verified_at:''}}
                                            </p>
                                            <p class="my-0 {{isset($user)&&$user->phone_verified_at?'text-success':'text-warning'}}">
                                                <i class="mdi mdi-phone"></i> {{isset($user)?$user->phone_verified_at:''}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="form-control select2" name="is_active" required>
                                                <option value="1" {{(isset($user)&&!Request::old('is_active'))? (($user->is_active  == '1')? 'selected':'') : ( (Request::old('is_active') =='1')? 'selected':'')}}>Active</option>
                                                <option value="0" {{(isset($user)&&!Request::old('is_active'))? (($user->is_active  == '0')? 'selected':'') : ( (Request::old('is_active') =='0')? 'selected':'')}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mt-4">
                                    <div class="col text-right">
                                        <button  type="submit" class="btn btn-primary"> <i class="mdi mdi-content-save mr-1"></i> Save</button>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js')}}"></script>
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
