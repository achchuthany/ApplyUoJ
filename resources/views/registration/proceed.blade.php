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
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card shadow-none">
                <div class="card-header font-weight-lighter font-size-20">
                    Your Online Application Status is  <span class="text-primary">{{$enroll->status}}</span>
                    <span class="float-right">Reference number is <b class="text-primary">{{$enroll->getRefNo()}}</b></span>
                </div>
            </div>
            <div class="card text-justify ">
                <div class="card-header">
                    <span class="text-success"> Your Online registration  has been successfully completed </span>and follow the Instructions to process your registration of University of Jaffna.
                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-12" >
                           <div class="media mt-4">
                               <div class="avatar-xs mr-3">
                                   <div class="avatar-title rounded-circle bg-soft-info text-primary font-size-14">
                                       1
                                   </div>
                               </div>
                               <div class="media-body">
                                   <p>
                                       Then download the application form, print it out and place your <b>signature</b> and insert the date at the appropriate place in the <b>printed version of the Online Application Form</b>.
                                   </p>
                               </div>
                           </div>

                           <div class="media mt-4">
                               <div class="avatar-xs mr-3">
                                   <div class="avatar-title rounded-circle bg-soft-info text-primary font-size-14">
                                       2
                                   </div>
                               </div>
                               <div class="media-body">
                                   <p>
                                       The signature of the applicant, should be attested (Signed and Stamped) by any one of the following persons:   Principle of  the approved school, Grama Niladhari of the Division, Justice of Peace, Commissioner of Oaths, Attorney at Law, Notary Public
                                   </p>
                               </div>
                           </div>

                           <div class="media mt-4">
                               <div class="avatar-xs mr-3">
                                   <div class="avatar-title rounded-circle bg-soft-info text-primary font-size-14">
                                       3
                                   </div>
                               </div>
                               <div class="media-body">
                                   <p class="font-weight-medium">
                                       The students should have to send hard copies of the following documents to the "Assistant Registrar, Admissions Branch, University of Jaffna" in the registered post. Write your “reference number” (which you are viewing top of this page) in the left hand of the envelop.
                                   </p>
                               </div>
                           </div>

                           <p class="font-weight-medium text-center">
                                The details of required documents  is listed below:
                           </p>
                       </div>
                       <div class="col-md-12">

                           <table class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Title</th>
                                  <th class="text-center">Original</th>
                                  <th class="text-center">Copy</th>
                                  <th class="text-center">Download</th>
                              </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td>Selection Letter sent by the UGC</td>
                                      <td class="text-center">-</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                      <td>2</td>
                                      <td>School Leaving Certificate</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                      <td>3</td>
                                      <td>Duly completed  Online Application  Form for Registration</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center"><a href="{{route('student.registration.download.PersonalData',['eid'=>$enroll->id])}}" class="btn btn-sm btn-link"> <i class="mdi mdi-download-outline"></i> Download</a></td>
                                  </tr>
                                  <tr>
                                      <td>4</td>
                                      <td>Payment voucher of registration fee and other fees of  Rs.2350 made by Peoples’ Bank</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                      <td class="text-center"><a href="{{URL::asset('/assets/images/download/PAYING_IN_VOUCHER.pdf')}}" download="PAYING_IN_VOUCHER.pdf" target="_blank" class="btn btn-sm btn-link"> <i class="mdi mdi-download-outline"></i> Download</a> </td>
                                  </tr>
                                  <tr>
                                      <td>5</td>
                                      <td>Declaration for Degree Certificate</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                      <td class="text-center"><a href="{{URL::asset('/assets/images/download/Declaration_Name_Degree_Certificate.pdf')}}" download="Declaration_Name_Degree_Certificate.pdf" target="_blank" class="btn btn-sm btn-link"> <i class="mdi mdi-download-outline"></i> Download</a></td>
                                  </tr>
                                  <tr>
                                      <td>6</td>
                                      <td>Duly completed declaration form on Prohibition of Ragging and other forms of violence</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                      <td class="text-center"><a href="{{URL::asset('/assets/images/download/Declaration_Ragging_Sinhala.pdf')}}" class="btn btn-sm btn-link m-2"  target="_blank" download="Declaration_Ragging_Sinhala.pdf"> <i class="mdi mdi-download-outline"></i> Sinhala</a>
                                          <a href="{{URL::asset('/assets/images/download/Declaration_Ragging_Tamil.pdf')}}" class="btn btn-sm btn-link"  target="_blank" download="Declaration_Ragging_Tamil.pdf"> <i class="mdi mdi-download-outline"></i> Tamil</a>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>7</td>
                                      <td>Student Identity Card Form</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                      <td class="text-center"><a href="{{URL::asset('/assets/images/download/IC_Form.pdf')}}" download="IC_Form.pdf" target="_blank" class="btn btn-sm btn-link"> <i class="mdi mdi-download-outline"></i> Download</a></td>
                                  </tr>
                                  <tr>
                                      <td>8</td>
                                      <td>Medical Form</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                      <td class="text-center"><a href="{{URL::asset('/assets/images/download/Medical_Form.pdf')}}" download="Medical_Form.pdf" target="_blank"  class="btn btn-sm btn-link"> <i class="mdi mdi-download-outline"></i> Download</a></td>
                                  </tr>
                                  <tr>
                                      <td>9</td>
                                      <td>10 copies of 4 X 5 cm. size colour Photograph of the applicant</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                      <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                      <td>10</td>
                                      <td>NIC Photocopy</td>
                                      <td class="text-center"></td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                      <td>11</td>
                                      <td>Birth Certificate</td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                      <td>12</td>
                                      <td>Photocopy of the G.C.E. (A/L) Certificate</td>
                                      <td class="text-center"></td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                      <td>13</td>
                                      <td>Photocopy of the G.C.E. (O/L) Certificate</td>
                                      <td class="text-center"></td>
                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                      <td>14</td>
                                      <td>Affidavit / Marriage certificate, if there is a difference in the name</td>

                                      <td class="text-center"><i class="mdi mdi-check-bold"></i> </td>
                                      <td class="text-center">-</td>
                                      <td class="text-center">-</td>
                                  </tr>
                              </tbody>
                           </table>
                           <div class="media mt-4">
                               <div class="avatar-xs mr-3">
                                   <div class="avatar-title rounded-circle bg-soft-info text-primary font-size-14">
                                       4
                                   </div>
                               </div>
                               <div class="media-body">
                                   <p>
                                       Students should affix photos in the On-line Application Form for Registration, Student Identity Card Form and Medical Form and the remaining photos should be sent to Admission Branch in an envelope by mentioning you’re A/L index number on the envelope.
                                   </p>
                               </div>
                           </div>

                           <div class="media mt-4">
                               <div class="avatar-xs mr-3">
                                   <div class="avatar-title rounded-circle bg-soft-info text-primary font-size-14">
                                       5
                                   </div>
                               </div>
                               <div class="media-body">
                                   <p>
                                       If a student cannot provide any of the above mentioned documents should give declaration about the reason for not submitting the same. (Form could be downloaded from website which is named as <a href="{{URL::asset('/assets/images/download/Non_Submission_of_Documents.pdf')}}" download="Non_Submission_of_Documents.pdf" target="_blank"  class="btn btn-sm btn-link">"<i class="mdi mdi-download-outline"></i> Non Submission of Documents”</a>).
                                   </p>
                               </div>
                           </div>

                           <div class="media mt-4">
                               <div class="avatar-xs mr-3">
                                   <div class="avatar-title rounded-circle bg-soft-info text-primary font-size-14">
                                       6
                                   </div>
                               </div>
                               <div class="media-body">
                                   <p>
                                       Photocopies of the documents should be certified by principal of the approved school/ Grama Niladhari of the Division/Justice of Peace,/Commissioner of Oaths,/Attorney at law/Notary Public.
                                   </p>
                               </div>
                           </div>
                       </div>
                   </div>
                </div> <div class="card-footer text-center">
                    Contact: Assistant  Registrar/Admissions Branch of the University of Jaffna. <i class="mdi mdi-phone"></i>+94 21 222 6714 \ <i class="mdi mdi-phone"></i> +94 21 221 8120
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
