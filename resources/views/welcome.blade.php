@extends('layouts.master-without-nav')
@section('title')
    Online Registration
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-transparent shadow-none">
                <div class="card-body">

                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-5">
                            <div class="text-center">
                                <a href="{{url('/')}}" class="d-block auth-logo">
                                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA"  class="img-fluid mx-auto d-block logo logo-dark">
                                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA" class="logo logo-light">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-transparent text-center mt-4">
                        <div class="h2  text-primary">
                            Online Registration of Students for Courses of Study - University of Jaffna
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-xl-12">
                            <div id="faqs-accordion" class="custom-accordion mt-5 mt-xl-0">
                                <div class="card border shadow-none">
                                    <a href="#faqs-gen-ques-collapse" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="faqs-gen-ques-collapse">
                                        <div class="bg-white p-3">

                                            <div class="media align-items-center">
                                                <div class="mr-3">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle font-size-22">
                                                            <i class="mdi mdi-account-details-outline"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-body overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Before start the online registration you need to know the following:</h5>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-16"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="faqs-gen-ques-collapse" class="collapse show" data-parent="#faqs-accordion">
                                        <div class="p-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-1"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted">Online Application Form   should be filled only in the English medium using BLOCK CAPITAL LETTERS.</p>
                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-2"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted">Full Name must be given as it is appeared in the Birth Certificate. (If the name in the Birth Certificate is different than the name which is in use, necessary amendments should be made in the Birth Certificate prior to get the registration)</p>
                                                            </div>
                                                        </div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-3"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted">  Please provide your permanent address, contact telephone number and email address to enable the Admission & Registration Branch of the University of Jaffna to communicate with you in future activities.</p>
                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-4"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted"> You should indicate your educational qualifications and examination results accurately and clearly.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-5"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p>Before start this online registration, please keep the scan images (JPG/JPEG and Each image size < 5MB) of Your photo, NIC Front Side, NIC Back Side, School Leaving Certificate Front Side , School Leaving Certificate Back Side and Paid Voucher(Use the <a href="{{URL::asset('/assets/images/download/PAYING_IN_VOUCHER.pdf')}}" download="PAYING_IN_VOUCHER.pdf" target="_blank" class="btn btn-sm btn-link"><i class="mdi mdi-download-outline"></i> Paying in Voucher </a> for your payment) </p>                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-6"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted"> You should complete all the entry requirements on or before the closing date.</p>                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-7"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted">Use the <b>'Start the Registration Now!'</b> button provided at the bottom of the page to start your registration.</p>                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border shadow-none">
                                    <a href="#faqs-privacy-policy-collapse" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="faqs-privacy-policy-collapse">
                                        <div class="bg-white p-3">

                                            <div class="media align-items-center">
                                                <div class="mr-3">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle font-size-22">
                                                            <i class="uil uil-shield-check"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-body overflow-hidden">
                                                    <h5 class="font-size-16 mb-1"> What happens after you have submitted your online registration?</h5>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-16"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="faqs-privacy-policy-collapse" class="collapse" data-parent="#faqs-accordion">
                                        <div class="p-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-1-circle-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted">You will receive a confirmation email</p>                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-2-circle-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted">You can monitor the progress of your online registration                         </p>                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div>
                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-3-circle-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted">You can continue to upload supporting documentation to your online registration</p>                                                            </div>
                                                        </div>

                                                        <div class="media mt-4">
                                                            <div class="avatar-xs mr-3">
                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary font-size-22">
                                                                    <i class="mdi mdi-numeric-4-circle-outline"></i>
                                                                </div>
                                                            </div>

                                                            <div class="media-body">
                                                                <p class="text-muted">Use the <b>'Manage your application'</b> button provided at the bottom of the page to manage your online registration.</p>                                                        </div>
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

                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-6">
                            <div class="text-center">
                                <div>
                                    <a href="{{route('login')}}" class="btn btn-secondary m-2"><i class="mdi mdi-account-outline"></i> Manage your application </a>
                                    <a href="{{route('register')}}" class="btn btn-primary m-2"><i class="mdi mdi-progress-check"></i> Start the Registration Now!</a>                                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <!-- end row -->
@endsection
