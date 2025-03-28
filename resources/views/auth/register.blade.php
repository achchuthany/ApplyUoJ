@extends('layouts.master-without-nav-index')
@section('title')
Register
@endsection
@section('content')
<div class="account-pages">
    <div class="container">
        <div class="row vh-100 align-items-center justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-9">
                <div class="card rounded-lg shadow-lg mt-3">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-12 m-0">
                                <div class="text-center">
                                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="" height="70" class="logo">
                                    <a href="{{route('home')}}">
                                        <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="40" class="logo">
                                        <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="40" class="logo">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-2">
                            <h5 class="text-dark text-uppercase font-weight-lighter">Student Enrolment</h5>
                            <p class="text-muted font-weight-lighter">Verifying your admission and creating your online enrolment user account in MyUoJ.</p>
                        </div>
                        <div class="p-2 mt-1">
                            @include('common-components.flash-message')
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

{{--                                <div class="form-group">--}}
{{--                                    <label for="name">{{ __('Name') }}</label>--}}
{{--                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter username">--}}

{{--                                        @error('name')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @enderror--}}
{{--                                </div>--}}
                                <div class="text-muted mb-2">
                                    <div>
                                        Please enter the email address and mobile number that we will use to contact you.
                                    </div>
                                    <div>
                                        You will need to setup a username and password so that you can login to MyUoJ. Your username for MyUoJ will be your email address.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nic">{{ __('National Identity Card / Passport No.') }}</label>
                                            <input id="nic" type="text" class="form-control @error('nic') is-invalid @enderror" name="nic" value="{{ old('nic') }}" required autocomplete="nic" autofocus placeholder="Enter National Identity Card / Passport No">

                                            @error('nic')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="al">{{ __('Index No. of the G.C.E(A/L) Examination') }}</label>
                                            <input id="al" type="text" class="form-control @error('al') is-invalid @enderror" name="al" value="{{ old('al') }}" required autocomplete="al" autofocus placeholder="Enter Index No. of the G.C.E(A/L) Examination">

                                            @error('al')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">{{ __('Mobile Number') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-text">+94</div>
                                                <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus placeholder="07XXXXXXXX">
                                            </div>
                                            <div>Enter the correct mobile number to receive SMS notifications.</div>
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('E-Mail Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email address">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter password (minimum 8 characters)">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Enter password">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">{{ __('Continue') }}<i class="mdi mdi-arrow-right-circle-outline ml-1"></i> </button>
                                </div>
                                <div class="mt-2 text-center">
                                    <p class="mb-0">Already have an account? <a href="{{url('login')}}" class="font-weight-medium text-primary">  Sign in </a> </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</div>
@endsection
