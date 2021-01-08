@extends('layouts.master-without-nav')
@section('title')
Verify Your Email Address
@endsection
@section('content')
<div class="account-pages my-2 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="text-center">
                            <a href="{{route('home')}}" class="d-block auth-logo">
                                <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="40" class="logo logo-dark">
                                <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="40" class="logo logo-light">
                            </a>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="text-center">
                            <h5 class="text-dark">{{ __('Activate your account') }}</h5>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                           {{ __('Your email address is ') }} <b>{{Auth::user()->email }}</b>
                        </p>
                            <div class="h6">
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                            </div>
                    </div>
                    <div class="card-footer">
                        {{ __('If your email address is wrong,') }}
                        <form class="d-inline" method="POST" action="{{ route('user.reset') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to Start the Registration Again') }} <i class="mdi mdi-history"></i></button>.
                        </form>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p>© 2020 {{config('app.name')}}. Developed by <a href="https://cv.achchuthan.org" class="btn-link">ACHCHUTHAN.ORG</a> </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</div>
@endsection
