@extends('layouts.master-topbar')
@section('title')
    Personal Data of Students
@endsection
@section('css')
    <!-- Lightbox css -->
    <link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="col-md-10 col-lg-10 col-xl-10">
            <div class="card">
                <div class="card-header font-size-24 text-center font-weight-lighter bg-soft-primary">
                    On-line Application Status :  <span class="text-primary">{{$enroll->status}}</span>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col">
                            01.  On-line Application Form (Personal Data of Students) Form
                        </div>
                        <div class="col">
                            <a href="{{route('student.registration.download.PersonalData')}}" class="btn btn-sm btn-outline-primary"> <i class="mdi mdi-download"></i> Download</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            02. Bank Voucher for Payment of Registration Form
                        </div>
                        <div class="col">
                            <button href="#" class="btn btn-sm btn-outline-primary"> <i class="mdi mdi-download"></i> Download</button>
                        </div>
                    </div>
                </div>

                <div class="card-header font-size-16">
                    Instructions
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12" >
                           <p>
                              <i class="mdi mdi-arrow-right-bold text-info"></i> Then download the application form, print it out and place your <b>signature</b> and insert the date at the appropriate place in the <b>printed version of the On-line Application Form</b>.
                           </p>
                           <p>
                               <i class="mdi mdi-arrow-right-bold text-info"></i>   The signature of the applicant, should be attested (Signed and Stamped) by any one of the following persons:   Principle of  the approved school, Grama Niladhari of the Division, Justice of Peace, Commissioner of Oaths, Attorney at Law, Notary Public
                           </p>
                           <p>
                               <i class="mdi mdi-arrow-right-bold text-info"></i>  The printed version must be submitted  along with the certified copies (A4 size) of the following documents.
                           </p>
                       </div>
                       <div class="col-md-12 pl-5">
                            <p>
                                <i class="mdi mdi-arrow-right-bold text-info"></i>   Photocopy of the Selection Letter of the UGC
                            </p>
                           <p>
                               <i class="mdi mdi-arrow-right-bold text-info"></i>  Bank Voucher for Payment of Registration and Other Fees for <b>Rs.2350.00</b>
                           </p>
                           <p>
                               <i class="mdi mdi-arrow-right-bold text-info"></i>  Photocopy of the NIC ( Principle of  the approved school, Grama Niladhari of the Division, Justice of Peace, Commissioner of Oaths, Attorney at Law, Notary Public )
                           </p>
                           <p>
                               <i class="mdi mdi-arrow-right-bold text-info"></i>  Original of the G.C.E. (A/L) Certificate issued by the Department of Examinations / Results sheet
                               issued by the Principal of the school and photocopies of the same certified by Principle of  the approved school, Grama Niladhari of the Division, Justice of Peace, Commissioner of Oaths, Attorney at Law, Notary Public
                           </p>
                           <p>
                               <i class="mdi mdi-arrow-right-bold text-info"></i>  Originals and Photocopies of the G.C.E. (O/L) Certificates issued by the Department of Examinations
                               / Results sheet issued by the Principal of the school and photocopies of the same certified by Principle of  the approved school, Grama Niladhari of the Division, Justice of Peace, Commissioner of Oaths, Attorney at Law, Notary Public
                           </p>
                           <p>
                               <i class="mdi mdi-arrow-right-bold text-info"></i>  Original of the Student Record Sheet (School Leaving Certificate)
                           </p>
                           <p>
                               <i class="mdi mdi-arrow-right-bold text-info"></i>   Original Birth Certificate and the photocopy of the certificate should be certified by Principle of  the approved school, Grama Niladhari of the Division, Justice of Peace, Commissioner of Oaths, Attorney at Law, Notary Public
                           </p>
                       </div>
                   </div>
                </div>
                <div class="card-footer bg-soft-secondary">
                     For further information, please contact: Deputy Registrar/Admission & Registration Branch of the University of Jaffna. 021 2226714 or 0212218120.
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Magnific Popup-->
    <script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>
    <!-- lightbox init js-->
    <script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>
@endsection
