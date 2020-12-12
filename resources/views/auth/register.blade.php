@extends('layouts.master-without-nav')
@section('title')
Register
@endsection
@section('content')
<div class="account-pages">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-0">
                <div class="text-center">
                    <a href="{{route('home')}}" class="mb-5 d-block auth-logo">
                        <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="" height="80" class="logo logo-dark">
                        <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="" height="80" class="logo logo-light">
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body p-4 shadow-lg ">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Register Account</h5>
                            <p class="text-muted">Get your {{config('app.name')}} account now.</p>
                        </div>
                        <div class="p-2 mt-4">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter username">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

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
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter password">

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

                                <div class="mt-3 text-right">
                                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">{{ __('Next') }}</button>
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

