@extends('layouts.master-without-nav')
@section('title')
Login
@endsection
@section('content')
<div class="account-pages">
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-md-10">
                <div class="card ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <img src="{{URL::asset('assets/images/account.gif')}}" class="img-fluid"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <a href="{{route('home')}}" class="mb-5 d-block auth-logo">
                                                <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="40" class="logo logo-light">
                                                <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="40" class="logo logo-dark">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                    <div class="text-center">
                                        <h5 class="text-primary">My Applications</h5>
                                        <p class="text-muted">Sign in below to manage existing applications and upload documents.</p>
                                    </div>
                                    <div class="">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="form-group">
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
                                                <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">{{ __('Log In') }}</button>
                                            </div>
                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Don't have an account ? <a href="{{url('register')}}" class="font-weight-medium text-primary"> Start new application </a> </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2 text-center">
                            <p>© 2020 {{config('app.name')}}. Developed by <a href="https://cv.achchuthan.org" class="btn-link">ACHCHUTHAN.ORG</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end container -->
</div>
@endsection

