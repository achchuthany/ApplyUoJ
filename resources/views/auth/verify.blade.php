@extends('layouts.master-without-nav')
@section('title')
Verify Your Email Address
@endsection
@section('content')
<div class="account-pages my-2 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="{{route('home')}}" class="mb-5 d-block auth-logo">
                        <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="40" class="logo logo-dark">
                        <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="40" class="logo logo-light">
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-header bg-info text-light">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body shadow-lg">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('Your email is ').Auth::user()->email }}.
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
                        {{ __('If your email address is wrong contact System Administrator.') }}
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
