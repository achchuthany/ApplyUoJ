@extends('layouts.master-without-nav-index')
@section('title')
Login
@endsection
@section('content')
<div class="account-pages">
    <div class="container">
        <div class="row justify-content-center align-items-center my-5">
            <div class="col-md-12">
                <div class="">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="d-flex justify-content-center">
                                <a href="{{route('home')}}">
                                    <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="MyUoJ" height="30" class="logo logo-dark">
                                </a>
                            </div>

                            @if($isShow)
                            <div class="card-body">
                                <div class="h5 text-uppercase text-center">
                                    Closing Dates for STUDENT Enrolment
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" >
                                        <thead>
                                        <th>Programme</th>
                                        <th>Closing Date</th>
                                        <th>Enrolment</th>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $row)
                                            <tr>
                                                <td> {{$row->programme->name}} - {{$row->academic_year->name}} </td>
                                                <td> {{\Carbon\Carbon::parse($row->close_date)->toDayDateTimeString()}} </td>
                                                <th> <a href="{{route('welcome')}}" class="btn btn-primary btn-sm">Enrol now</a> </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-5">
                            <div class="card rounded-lg shadow-lg p-2">
                                <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="University of Jaffna" height="70" class="logo">
                                        </div>
                                    </div>
                                </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <div class="text-center h6 text-uppercase">Sign in to manage your Online Enrolment</div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="form-group ">
                                                <label for="email">{{ __('E-Mail Address') }}</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email address">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="float-right">
                                                    @if (Route::has('password.request'))
                                                        <a class="text-muted" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                                <label for="password">{{ __('Password') }}</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="auth-remember-check" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="auth-remember-check">{{ __('Remember Me') }}</label>
                                            </div>
                                            <div class="mt-3 text-right">
                                                <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">{{ __('Log In') }} <i class="mdi mdi-login-variant"></i> </button>
                                            </div>
                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Don't Have an Account?<a href="{{url('apply')}}" > Create account</a>  </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-2 text-center text-muted">
                                        <p>© {{ date('Y') }}  {{config('app.name')}}</p> <p> All Rights Reserved</p>
                                        <div class="font-size-12 py-3 bg-light">
                                            <span class=""> <i class="mdi mdi-email"></i> admissions@univ.jfn.ac.lk</span>
                                            <span class="ml-1"> <i class="mdi mdi-phone"></i> +94 021 221 8120</span>
                                            <span class="ml-1"> <i class="mdi mdi-phone"></i> +94 021 222 6714</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end container -->
</div>
@endsection

