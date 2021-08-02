@extends('layouts.master-without-nav-index')
@section('title')
    Online Registration
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card my-2 bg-light">
                <div class="card-body">
                    <div class="row justify-content-center bg-light p-3">
                        <div class="col-lg-5">
                            <div class="text-center">
                                <a href="{{url('/')}}" class="d-block auth-logo">
                                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA"  class="img-fluid mx-auto d-block logo logo-dark">
                                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA" class="logo logo-light">
                                </a>
                                <a href="{{route('home')}}" class="mb-1 d-block auth-logo">
                                    <img src="{{ URL::asset('assets/images/logo-light.png')}}" alt="" height="40" class="logo logo-light">
                                    <img src="{{ URL::asset('assets/images/logo-dark.png')}}" alt="" height="40" class="logo logo-dark">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-transparent text-center mt-2">
                        <div class="font-weight-lighter text-dark">
                            <h2 class="text-uppercase">
                                Online Enrolment for ACADEMIC PROGRAMME
                            </h2>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-xl-12">
                            <div id="faqs-accordion" class="custom-accordion mt-5 mt-xl-0">
                                <div class="card border shadow-none">
                                    <a href="#step1" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="faqs-gen-ques-collapse">
                                        <div class="bg-soft-dark p-3">

                                            <div class="media align-items-center">
                                                <div class="media-body overflow-hidden">
                                                    <h5 class="font-size-16 mb-1 text-dark">Before start the online enrolment you need to know the following:</h5>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-16 text-light"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="step1" class="collapse show" data-parent="#faqs-accordion">
                                        <div class="p-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-1"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark">Online Application Form   should be filled only in the English medium using BLOCK CAPITAL LETTERS.</p>
                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-2"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark">Full Name must be given as it is appeared in the Birth Certificate. (If the name in the Birth Certificate is different than the name which is in use, necessary amendments should be made in the Birth Certificate prior to get the registration)</p>
                                                            </div>
                                                        </div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-3"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark">  Please provide your permanent address, contact telephone number and email address to enable the Admissions Branch of the University of Jaffna to communicate with you in future activities.</p>
                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-4"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark"> You should indicate your educational qualifications and examination results accurately and clearly.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-5"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body text-dark">
                                                                <p>Following documents will be required to be uploaded to process your application. Therefore, please have the documents scanned into either ‘ jpeg’ or 'jpg' formats and each image size should be less than 5MB</p>
                                                                <ol>
                                                                    <li>Your recent photograph.</li>
                                                                    <li>Selection Letter sent by the UGC</li>
                                                                    <li>Paid Bank Slip <a href="{{route('info')}}" > - Payment Details </a></li>
                                                                    <li>School Leaving Certificate Front Side</li>
                                                                    <li>School Leaving Certificate Back Side</li>
                                                                    <li>National Identity Card Front Side</li>
                                                                    <li>National Identity Card Back Side</li>
{{--                                                                    <li>Birth Certificate (Original) Front Side</li>--}}
{{--                                                                    <li>Birth Certificate (Original) Back Side </li>--}}
{{--                                                                    <li>G.C.E. (A/L) Certificate Front Side </li>--}}
{{--                                                                    <li>G.C.E. (A/L) Certificate Back Side </li>--}}
{{--                                                                    <li>G.C.E. (O/L) Certificate Front Side </li>--}}
{{--                                                                    <li>G.C.E. (O/L) Certificate Back Side </li>--}}
                                                                </ol>
                                                             </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-6"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark"> You should complete all the entry requirements on or before the <a href="{{route('info')}}" > closing date</a>.</p>                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-7"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark">Use the <b>"Start the Enrolment Now"</b> button provided at the bottom of the page to start your registration.</p>                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border shadow-none">
                                    <a href="#step2" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="faqs-privacy-policy-collapse">
                                        <div class="bg-soft-dark p-3">

                                            <div class="media align-items-center">
                                                <div class="media-body overflow-hidden">
                                                    <h5 class="font-size-16 mb-1 text-dark"> What happens after you have submitted your online enrolment?</h5>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-16 text-light"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="step2" class="collapse show" data-parent="#faqs-accordion">
                                        <div class="p-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-1-circle-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark">You will receive a confirmation email</p>                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-2-circle-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark">
                                                                    You can monitor the progress of your online enrolment
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-3-circle-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark">You can continue to upload supporting documentation to your online enrolment</p>                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-dark text-dark font-size-22">
                                                                    <i class="mdi mdi-numeric-4-circle-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-dark">Use the <b>'Manage your enrolment'</b> button provided at the bottom of the page to manage your online enrolment.</p>                                                        </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div id="faqs-privacy-policy-collapse" class="collapse" data-parent="#faqs-accordion">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-right">
                                <div>
                                    <a href="{{route('login')}}" class="btn btn-secondary m-2"> Manage your enrolment </a>
                                    <a href="{{route('register')}}" class="btn btn-primary m-2">Start the Enrolment Now </a>                                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center p-3">
                        <div class="col-lg-12 text-center mt-3 px-2">
                                <div>If you have any queries regarding your registration or any other matters, please contact us by  email/phone given below.
                        </div>
                        </div>
                        <div class="col-md-3">
                            <div> <i class="mdi mdi-email"></i> admissions@univ.jfn.ac.lk</div>
                        </div>
                        <div class="col-md-2">
                            <div> <i class="mdi mdi-phone"></i> +94 021 221 8120</div>
                        </div>
                        <div class="col-md-2">
                            <div> <i class="mdi mdi-phone"></i> +94 021 222 6714</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <!-- end row -->
@endsection
