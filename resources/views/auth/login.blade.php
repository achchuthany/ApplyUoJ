@extends('layouts.master-without-nav-index')
@section('title')
Login
@endsection
@section('content')
<div class="account-pages">
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            @if($isShow)
                            <div class="card-body bg-light shadow-lg rounded-lg my-3 p-4">
                                <a href="{{route('home')}}" class="mb-5 d-block auth-logo">
                                    <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="40" class="logo logo-light">
                                    <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="40" class="logo logo-dark">
                                </a>
                                <div class="p-3 text-center text-dark font-weight-lighter font-size-20">
                                    Online Registration of Students for the following Courses
                                </div>
                                <div class="table-responsive text-light">
                                    <table class="table table-borderless table-striped">
                                        <thead class="bg-info text-light">
                                        <th>Programme</th>
                                        <th>Closing Date</th>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $row)
                                            <tr>
                                                <td>{{$row->programme->name}}</td>
                                                <td>{{\Carbon\Carbon::parse($row->close_date)->toFormattedDateString()}} ({{\Carbon\Carbon::parse($row->close_date)->diffForHumans()}})</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center text-muted border-info ">
                                    <span class="mx-2"> <i class="mdi mdi-email"></i> admissions@univ.jfn.ac.lk</span>
                                    <span class="mx-2"> <i class="mdi mdi-phone"></i> +94 021 221 8120</span>
                                    <span class="mx-2"> <i class="mdi mdi-phone"></i> +94 021 222 6714</span>
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
                                            <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="" height="70" class="logo">
                                        </div>
                                    </div>
                                </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <div class="text-center h6 text-uppercase">Sign in to manage your Online Enrollment</div>
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
                                                <p class="mb-0">Don't have an account ? <a href="{{url('apply')}}" class="font-weight-medium text-primary"> Apply now </a> </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-2 text-center text-muted">
                                        <p>© {{ date('Y') }}  {{config('app.name')}}</p> <p> All Rights Reserved</p>
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

