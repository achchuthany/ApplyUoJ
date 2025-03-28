@extends('layouts.master-topbar')
@section('title')
    {{$enroll->student->name_initials}}
@endsection
@section('css')
    <!-- Lightbox css -->
    <link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Home @endslot
    @slot('title') {{$enroll->student->name_initials}} @endslot
@endcomponent

    <div class="row mb-4">
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown float-right text-dark">
                            <a href="{{route('student.registration.completed')}}">Instructions</a>
                        </div>
                        <div class="dropdown float-left text-dark">
                            <i class="mdi mdi-information-outline"></i> <span id="enroll_status">{{$enroll->status}}</span>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                                @if($enroll->student->student_docs()->where('type','photo')->first() && Storage::disk('docs')->exists($enroll->student->student_docs()->where('type','photo')->first()->name))
                                <a class="image-popup-no-margins" href="/registration/student/image/{{$enroll->student->student_docs()->where('type','photo')->first()->name}}">
                                <img src="/registration/student/image/{{$enroll->student->student_docs()->where('type','photo')->first()->name}}" alt="{{$enroll->student->student_docs()->where('type','photo')->first()->type}}" class="img-fluid  img-thumbnail">
                                </a>
                                @else
                                <img class="img-fluid avatar-lg rounded-circle img-thumbnail" alt="" src="{{ URL::asset('assets/images/users/user.png')}}" width="75">
                                @endif

                        </div>
                        <h6 class="mt-3 mb-1 text-capitalize">{{$enroll->student->title}} {{$enroll->student->name_initials}}</h6>
                        <p class="text-muted mb-0">{{$enroll->programme->name}}</p>
                        <p class="text-muted mt-0">{{$enroll->academic_year->name}}</p>
                    </div>

                    <hr class="my-4">

                    <div class="text-muted">
                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Faculty</p>
                                <h5 class="font-size-16">{{$enroll->programme->faculty->name}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Course of Study</p>
                                <h5 class="font-size-16">{{$enroll->programme->name}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Academic Year</p>
                                <h5 class="font-size-16">{{$enroll->academic_year->name}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Index Number</p>
                                <h5 class="font-size-16 {{$enroll->index_no? '': 'text-info'}} ">{{$enroll->index_no? $enroll->index_no: 'Not Assigned'}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Registration Number</p>
                                <h5 class="font-size-16 {{$enroll->reg_no? '': 'text-info'}} ">{{$enroll->reg_no? $enroll->reg_no: 'Not Assigned'}} </h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Date of Registration</p>
                                <h5 class="font-size-16 {{$enroll->registration_date? '': 'text-info'}} ">{{$enroll->registration_date? Carbon\Carbon::parse($enroll->registration_date)->toFormattedDateString(): 'Not Assigned'}}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Payer ID</p>
                                <h5 class="font-size-16 {{$enroll->payer_id? '': 'text-info'}} ">{{$enroll->payer_id??'Not Assigned'}}</h5>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <small>Contact</small>
                    <div>Admissions Branch, University of Jaffna </div>
                     <div><i class="mdi mdi-phone"></i>+94 21 222 6714 <i class="mdi mdi-phone"></i> +94 21 221 8120</div>
                    <div><i class="mdi mdi-email"></i> admissions@univ.jfn.ac.lk</div>
                </div>
                <div class="card-footer">
                    <div class="font-size-10">
                        <i class="mdi mdi-clock-outline"></i> <span class="text-muted">Updated at {{$enroll->updated_at->diffForHumans()}} </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card mb-0 h-100">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#about" role="tab">
                            <i class="uil uil-user-circle font-size-20"></i>
                            <span class="d-none d-sm-block">About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#education" role="tab">
                            <i class="uil  uil-book-open font-size-20"></i>
                            <span class="d-none d-sm-block">Educations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#citizenship" role="tab">
                            <i class="uil uil-globe font-size-20"></i>
                            <span class="d-none d-sm-block  ">Citizenship</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#parents" role="tab">
                            <i class="uil uil-mailbox-alt  font-size-20"></i>
                            <span class="d-none d-sm-block">Parents/Guardian</span>
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" data-toggle="tab" href="#files" role="tab">--}}
{{--                            <i class="uil  uil-file  font-size-20"></i>--}}
{{--                            <span class="d-none d-sm-block">Files</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" data-toggle="tab" href="#log" role="tab">--}}
{{--                            <i class="uil   uil-clock   font-size-20"></i>--}}
{{--                            <span class="d-none d-sm-block">Logs</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                </ul>


                <!-- Tab content -->
                <div class="tab-content p-4">
                    <div class="tab-pane active" id="about" role="tabpanel">
                        <div>
                            <div class="font-size-16 card-header">Personal Information</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Title</p>
                                            <h5 class="font-size-16">{{$enroll->student->title}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Last Name or Surname</p>
                                            <h5 class="font-size-16 {{$enroll->student->last_name? '': 'text-info'}}">{{$enroll->student->last_name? $enroll->student->last_name: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Name with Initials</p>
                                            <h5 class="font-size-16 {{$enroll->student->name_initials? '': 'text-info'}}">{{$enroll->student->name_initials? $enroll->student->name_initials: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Full Name</p>
                                            <h5 class="font-size-16">{{$enroll->student->full_name}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">National Identity Card (NIC)</p>
                                            <h5 class="font-size-16">{{$enroll->student->nic}}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Mobile</p>
                                            <h5 class="font-size-16">{{$enroll->student->mobile}}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Email</p>
                                            <h5 class="font-size-16">{{$enroll->student->email}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Province</p>
                                            <h5 class="font-size-16 {{$enroll->student->province? '': 'text-info'}}">{{$enroll->student->province? $enroll->student->province: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">District</p>
                                            <h5 class="font-size-16 {{$enroll->student->district? '': 'text-info'}}">{{$enroll->student->district? $enroll->student->district: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">District No.</p>
                                            <h5 class="font-size-16 {{$enroll->student->district_no? '': 'text-info'}}">{{$enroll->student->district_no? $enroll->student->district_no: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="font-size-16 card-header">Address</div>
                            <div class="card-body">
                                @foreach($enroll->student->addresses as $addr)
                                    <div class="card-title text-secondary mt-4 border-bottom">{{$addr->address_type}}</div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Address No</p>
                                                <h5 class="font-size-16">{{$addr->address_no}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Street</p>
                                                <h5 class="font-size-16 {{$addr->address_street? '': 'text-info'}}">{{$addr->address_street? $addr->address_street: 'Not Assigned'}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">City</p>
                                                <h5 class="font-size-16 {{$addr->address_city? '': 'text-info'}}">{{$addr->address_city? $addr->address_city: 'Not Assigned'}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Address</p>
                                                <h5 class="font-size-16 {{$addr->address_4? '': 'text-info'}}">{{$addr->address_4? $addr->address_4: 'Not Assigned'}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">State</p>
                                                <h5 class="font-size-16 {{$addr->address_state? '': 'text-info'}}">{{$addr->address_state? $addr->address_state: 'Not Assigned'}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Country</p>
                                                <h5 class="font-size-16 {{$addr->address_country? '': 'text-info'}}">{{$addr->address_country? $addr->address_country: 'Not Assigned'}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Postal Code</p>
                                                <h5 class="font-size-16 {{$addr->address_postal_code? '': 'text-info'}}">{{$addr->address_postal_code? $addr->address_postal_code: 'Not Assigned'}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="education" role="tabpanel">
                        <div>
                            <div class="font-size-16 card-header">G.C.E (A/L) Examinations</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Year</p>
                                            <h5 class="font-size-16 {{$enroll->student->al_exam_year? '': 'text-info'}}">{{$enroll->student->al_exam_year? $enroll->student->al_exam_year: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Index Number</p>
                                            <h5 class="font-size-16 {{$enroll->student->al_index_number? '': 'text-info'}}">{{$enroll->student->al_index_number? $enroll->student->al_index_number: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Average Z Score</p>
                                            <h5 class="font-size-16 {{$enroll->student->al_z_score? '': 'text-info'}}">{{$enroll->student->al_z_score? $enroll->student->al_z_score: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">English Marks</p>
                                            <h5 class="font-size-16 {{$enroll->student->al_english_mark ? '': 'text-info'}}">{{$enroll->student->al_english_mark ? $enroll->student->al_english_mark : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($enroll->student->student_al_exams)
                            <div class="font-size-16 card-header">Examination Results</div>
                            <div class="card-body">
                                @foreach($enroll->student->student_al_exams as $al_exam)
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Subject</p>
                                                <h5 class="font-size-16 {{$al_exam->subject? '': 'text-info'}}">{{$al_exam->subject? $al_exam->subject: 'Not Assigned'}}</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mt-4">
                                                <p class="text-muted mb-1">Grade</p>
                                                <h5 class="font-size-16 {{$al_exam->grade? '': 'text-info'}}">{{$al_exam->grade? $al_exam->grade: 'Not Assigned'}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane" id="citizenship" role="tabpanel">
                        <div>
                            <div class="font-size-16 card-header">Details of Citizenship</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Race</p>
                                            <h5 class="font-size-16 {{$enroll->student->race? '': 'text-info'}}">{{$enroll->student->race? $race: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Gender </p>
                                            <h5 class="font-size-16 {{$enroll->student->gender ? '': 'text-info'}}">{{$enroll->student->gender ? $gender : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Civil Status </p>
                                            <h5 class="font-size-16 {{$enroll->student->civil_status ? '': 'text-info'}}">{{$enroll->student->civil_status ? $civil_status : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Religion  </p>
                                            <h5 class="font-size-16 {{$enroll->student->religion  ? '': 'text-info'}}">{{$enroll->student->religion  ? $religion  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Date of Birth  </p>
                                            <h5 class="font-size-16 {{$enroll->student->date_of_birth  ? '': 'text-info'}}">{{$enroll->student->date_of_birth  ? Carbon\Carbon::parse($enroll->student->date_of_birth)->toFormattedDateString()  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Age (Now) </p>
                                            <h5 class="font-size-16 {{$enroll->student->date_of_birth  ? '': 'text-info'}}">{{$enroll->student->date_of_birth  ? Carbon\Carbon::now()->diffInYears(Carbon\Carbon::parse($enroll->student->date_of_birth)).' years '  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Citizenship</p>
                                            <h5 class="font-size-16 {{$enroll->student->citizenship  ? '': 'text-info'}}">{{$enroll->student->citizenship  ? $enroll->student->citizenship  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Citizenship</p>
                                            <h5 class="font-size-16 {{$enroll->student->citizenship_type  ? '': 'text-info'}}">{{$enroll->student->citizenship_type  ? $enroll->student->citizenship_type  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="parents" role="tabpanel">
                        <div>
                            <div class="font-size-16 card-header">Details of Parents/Guardian</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Full name of Father/Mother/Guardian</p>
                                            <h5 class="font-size-16 {{$enroll->student->parent_full_name? '': 'text-info'}}">{{$enroll->student->parent_full_name? $enroll->student->parent_full_name: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Occupation </p>
                                            <h5 class="font-size-16 {{$enroll->student->parent_occupation  ? '': 'text-info'}}">{{$enroll->student->parent_occupation  ? $enroll->student->parent_occupation  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Address of the place of work </p>
                                            <h5 class="font-size-16 {{$enroll->student->parent_address_work  ? '': 'text-info'}}">{{$enroll->student->parent_address_work  ? $enroll->student->parent_address_work  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Telephone No.  </p>
                                            <h5 class="font-size-16 {{$enroll->student->parent_mobile  ? '': 'text-info'}}">{{$enroll->student->parent_mobile  ? $enroll->student->parent_mobile  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Telephone Land No.  </p>
                                            <h5 class="font-size-16 {{$enroll->student->parent_landline   ? '': 'text-info'}}">{{$enroll->student->parent_landline   ? $enroll->student->parent_landline   : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="font-size-16 card-header">Emergency Contact</div>
                            <div class="card-body bg-soft-dark">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1 ">Name</p>
                                            <h5 class="font-size-16 {{$enroll->student->emergency_contact_name? '': 'text-info'}}">{{$enroll->student->emergency_contact_name? $enroll->student->emergency_contact_name: 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mt-4">
                                            <p class="text-muted mb-1">Phone </p>
                                            <h5 class="font-size-16 {{$enroll->student->emergency_contact_mobile  ? '': 'text-info'}}">{{$enroll->student->emergency_contact_mobile  ? $enroll->student->emergency_contact_mobile  : 'Not Assigned'}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

{{--                    <div class="tab-pane" id="files" role="tabpanel">--}}
{{--                        <div>--}}
{{--                            <div class="font-size-16 card-header">Details of Attachments/Files</div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="zoom-gallery">--}}
{{--                                    <div class="row">--}}
{{--                                        @foreach($enroll->student->student_docs()->get() as $doc)--}}
{{--                                            @if(Storage::disk('docs')->exists($doc->name))--}}
{{--                                                <div class="col-md-6">--}}
{{--                                                    <div class="card-title mb-1">{{$doc->name}}</div>--}}
{{--                                                <a href="/registration/student/image/{{$doc->name}}" title="{{$doc->name}}"><img src="/registration/student/image/{{$doc->name}}" alt="{{$doc->type}}" class="rounded-sm img-thumbnail"></a>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="tab-pane" id="log" role="tabpanel">--}}
{{--                        <div>--}}
{{--                            <div data-simplebar style="max-height: 430px;">--}}
{{--                                <div class="media border-bottom py-4">--}}
{{--                                    <img class="mr-2 rounded-circle avatar-xs" src="{{ URL::asset('assets/images/users/male.png')}}" alt="">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="font-size-15 mt-0 mb-1">Marion Walker <small class="text-muted float-right">1 hr ago</small></h5>--}}
{{--                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting .</p>--}}

{{--                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i--}}
{{--                                            class="mdi mdi-reply"></i> Reply</a>--}}

{{--                                        <div class="media mt-4">--}}
{{--                                            <img class="mr-2 rounded-circle avatar-xs" src="{{ URL::asset('assets/images/users/male.png')}}" alt="">--}}
{{--                                            <div class="media-body">--}}
{{--                                                <h5 class="font-size-15 mt-0 mb-1">Shanon Marvin <small class="text-muted float-right">1 hr ago</small></h5>--}}
{{--                                                <p class="text-muted">It will be as simple as in fact, it will be Occidental. To it will seem like simplified .</p>--}}


{{--                                                <a href="javascript: void(0);" class="text-muted font-13 d-inline-block">--}}
{{--                                                    <i class="mdi mdi-reply"></i> Reply--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="media border-bottom py-4">--}}
{{--                                    <img class="mr-2 rounded-circle avatar-xs" src="{{ URL::asset('/assets/images/users/male.png')}}" alt="">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="font-size-15 mt-0 mb-1">Janice Morgan <small class="text-muted float-right">2 hrs ago</small></h5>--}}
{{--                                        <p class="text-muted">To achieve this, it would be necessary to have uniform pronunciation.</p>--}}

{{--                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i--}}
{{--                                            class="mdi mdi-reply"></i> Reply</a>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="media border-bottom py-4">--}}
{{--                                    <img class="mr-2 rounded-circle avatar-xs" src="{{ URL::asset('assets/images/users/male.png')}}" alt="">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="font-size-15 mt-0 mb-1">Patrick Petty <small class="text-muted float-right">3 hrs ago</small></h5>--}}
{{--                                        <p class="text-muted">Sed ut perspiciatis unde omnis iste natus error sit </p>--}}

{{--                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i--}}
{{--                                            class="mdi mdi-reply"></i> Reply</a>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="border rounded mt-4">--}}
{{--                                <form action="#">--}}
{{--                                    <div class="px-2 py-1 bg-light">--}}

{{--                                        <div class="btn-group" role="group">--}}
{{--                                            <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="uil uil-link"></i></button>--}}
{{--                                            <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="uil uil-smile"></i></button>--}}
{{--                                            <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="uil uil-at"></i></button>--}}
{{--                                            </div>--}}

{{--                                    </div>--}}
{{--                                    <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>--}}

{{--                                </form>--}}
{{--                            </div> <!-- end .border-->--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/action.enroll.index.js')}}"></script>

@endsection
