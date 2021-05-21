@extends('layouts.master-dark-sidebar')
@section('title')
Add a Student / Edit Student
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Lightbox css -->
    <link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/cropperjs/cropperjs.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 35mm;
            height: 45mm;
            margin: 10px;
            border: 1px solid red;
        }
        .modal-lg{
            max-width: 1000px !important;
        }

    </style>
@endsection
@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Student @endslot
    @slot('title') Add a Student / Edit Student @endslot
@endcomponent

    <div class="row">
        <div class="col-lg-12">
                <div class="bg-transparent">
                        <div class="py-2">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <h5 class="font-size-16 mb-1">Student Info </h5>
                                            <p class="text-muted text-truncate mb-0">Fill the necessary information below</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>
                        <div class="border-top">
                            <form class="needs-validation" method="POST" action="{{ route('admin.students.addEditProcess') }}">
                                {{ csrf_field() }}
                                @if(!isset($enroll))
                                <div class="card">
                                    <div class="card-header bg-dark text-light">
                                        Course Details
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="programme_id">Name of the Course of Study <span class="text-danger font-size-16">*</span></label>
                                                    <select class="form-control select2 @error('programme_id') is-invalid @enderror" name="programme_id" id="programme_id" required>
                                                        <option selected disabled>Select Programme Title</option>
                                                        @foreach($programmes as $programme)
                                                            <option value="{{$programme->id}}" >{{$programme->name.' - '.$programme->type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="academic_year_id">Academic Year <span class="text-danger font-size-16">*</span></label>
                                                    <select id="academic_year_id" class="form-control select2 @error('academic_year_id') is-invalid @enderror" name="academic_year_id" required>
                                                        <option selected disabled>Select Academic Year</option>
                                                        @foreach($academics as $academic)
                                                            <option value="{{$academic->id}}">{{$academic->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="reg_no">Registration Number <span><i class="mdi mdi-autorenew"></i> </span></label>
                                                    <input id="reg_no" name="reg_no" type="text" class="form-control bg-light" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="index_no">Index Number <i class="mdi mdi-autorenew"></i></label>
                                                    <input id="index_no" name="index_no" type="text" class="form-control bg-light" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="registration_date">Date of Registration <span class="text-danger font-size-16">*</span></label>
                                                    <input id="registration_date" name="registration_date" type="date" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                @endif
                                @if(isset($enroll))
                                    <div class="card">
                                        <div class="card-header bg-dark text-light">
                                            Course Details
                                        </div>
                                        @foreach($enrolls as $en)
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Name of the Course of Study</label>
                                                        <input type="text" value="{{$en->programme->name}}" class="form-control bg-light" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <input type="text" value="{{$en->status}}" class="form-control bg-light" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="academic_year_id">Academic Year</label>
                                                        <input type="text" value="{{$en->academic_year->name}}" class="form-control bg-light" disabled>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label >Registration Number</label>
                                                        <input  type="text" value="{{$en->reg_no}}" class="form-control bg-light" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="index_no">Index Number</label>
                                                        <input type="text" value="{{$en->index_no}}" class="form-control bg-light" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                        </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header bg-dark text-light">
                                        1. Personal Details
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="title">i. Title <span class="text-danger font-size-16">*</span></label>
                                                    <select id="title" name="title" class="form-control select2 @error('title') is-invalid @enderror" required>
                                                        <option selected disabled>Select Title</option>
                                                        <option value="Mr" {{(isset($student)&&!Request::old('title'))? ($student->title=='Mr'?'selected':'') : (Request::old('title')=='Mr'?'selected':'') }}>Mr</option>
                                                        <option value="Miss" {{(isset($student)&&!Request::old('title'))? ($student->title=='Miss'?'selected':'') : (Request::old('title')=='Miss'?'selected':'') }}>Miss</option>
                                                        <option value="Mrs" {{(isset($student)&&!Request::old('title'))? ($student->title=='Mrs'?'selected':'') : (Request::old('title')=='Mrs'?'selected':'') }}>Mrs</option>
                                                    </select>
                                                    @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="last_name">ii. Last Name or Surname of the Applicant <span class="text-danger font-size-16">*</span> </label>
                                                    <input value="{{isset($student)? $student->id : null}}" id="student_id" name="student_id" type="hidden">

                                                    <input value="{{(isset($student)&&!Request::old('last_name'))? $student->last_name : Request::old('last_name')}}" id="last_name" name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" required>
                                                    @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name_initials">iii. Name with Initials <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('name_initials'))? $student->name_initials : Request::old('name_initials')}}" id="name_initials" name="name_initials" type="text" class="form-control  @error('name_initials') is-invalid @enderror" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="full_name">iv. Full Name <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('full_name'))? $student->full_name : Request::old('full_name')}}" id="full_name" name="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-dark text-light">
                                        2. Address Details
                                    </div>
                                    <div class="card-body">
                                        <label for="name">i. Permanent Address</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_no">Address No <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($address_p)&&!Request::old('address_no'))? $address_p->address_no : Request::old('address_no')}}" id="address_no" name="address[P][address_no]" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_street">Address Street <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($address_p)&&!Request::old('address_street'))? $address_p->address_street : Request::old('address_street')}}" id="address_street" name="address[P][address_street]" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_city">Address City</label>
                                                    <input value="{{(isset($address_p)&&!Request::old('address_city'))? $address_p->address_city : Request::old('address_city')}}" id="address_city" name="address[P][address_city]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_4">Address Line 4</label>
                                                    <input value="{{(isset($address_p)&&!Request::old('address_4'))? $address_p->address_4 : Request::old('address_4')}}" id="address_4" name="address[P][address_4]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_state">Address State</label>
                                                    <input value="{{(isset($address_p)&&!Request::old('address_state'))? $address_p->address_state : Request::old('address_state')}}" id="address_state" name="address[P][address_state]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_country_p">Address Country <span class="text-danger font-size-16">*</span></label>
                                                    <select id="address_country_p" name="address[P][address_country]" class="form-control select2" required>
                                                        <option selected disabled>Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country}}" {{(isset($address_p)&&!Request::old('address_country'))? ($address_p->address_country==$country?'selected':'') : (Request::old('address_country')==$country?'selected':'') }}>{{$country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_postal_code">Address Postal Code</label>
                                                    <input value="{{(isset($address_p)&&!Request::old('address_postal_code'))? $address_p->address_postal_code : Request::old('address_postal_code')}}" id="address_postal_code" name="address[P][address_postal_code]" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <label for="name">ii. Contact Address</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_no">Address No <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($address_c)&&!Request::old('address_no'))? $address_c->address_no : Request::old('address_no')}}" id="address_no" name="address[C][address_no]" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_street">Address Street <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($address_c)&&!Request::old('address_street'))? $address_c->address_street : Request::old('address_street')}}" id="address_street" name="address[C][address_street]" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_city">Address City</label>
                                                    <input value="{{(isset($address_c)&&!Request::old('address_city'))? $address_c->address_city : Request::old('address_city')}}" id="address_city" name="address[C][address_city]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_4">Address Line 4</label>
                                                    <input value="{{(isset($address_c)&&!Request::old('address_4'))? $address_c->address_4 : Request::old('address_4')}}" id="address_4" name="address[C][address_4]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_state">Address State</label>
                                                    <input value="{{(isset($address_c)&&!Request::old('address_state'))? $address_c->address_state : Request::old('address_state')}}" id="address_state" name="address[C][address_state]" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_country">Address Country <span class="text-danger font-size-16">*</span></label>
                                                    <select id="address_country" name="address[C][address_country]" class="form-control select2" required>
                                                        <option selected disabled>Select Country</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country}}" {{(isset($address_c)&&!Request::old('address_country'))? ($address_c->address_country==$country?'selected':'') : (Request::old('address_country')==$country?'selected':'') }}>{{$country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address_postal_code">Address Postal Code</label>
                                                    <input value="{{(isset($address_c)&&!Request::old('address_postal_code'))? $address_c->address_postal_code : Request::old('address_postal_code')}}" id="address_postal_code" name="address[C][address_postal_code]" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="province">iii. Province <span class="text-danger font-size-16">*</span></label>
                                                    <select id="province" name="province" class="form-control select2 @error('province') is-invalid @enderror" required>
                                                        <option selected disabled>Select Province</option>
                                                        <option value="Central" {{(isset($student)&&!Request::old('province'))? ($student->province=='Central'?'selected':'') : (Request::old('province')=='Central'?'selected':'') }}>Central</option>
                                                        <option value="Eastern" {{(isset($student)&&!Request::old('province'))? ($student->province=='Eastern'?'selected':'') : (Request::old('province')=='Eastern'?'selected':'') }}>Eastern</option>
                                                        <option value="North Central" {{(isset($student)&&!Request::old('province'))? ($student->province=='North Central'?'selected':'') : (Request::old('province')=='North Central'?'selected':'') }}>North Central</option>
                                                        <option value="Northern" {{(isset($student)&&!Request::old('province'))? ($student->province=='Northern'?'selected':'') : (Request::old('province')=='Northern'?'selected':'') }}>Northern</option>
                                                        <option value="North Western" {{(isset($student)&&!Request::old('province'))? ($student->province=='North Western'?'selected':'') : (Request::old('province')=='North Western'?'selected':'') }}>North Western</option>
                                                        <option value="Sabaragamuwa" {{(isset($student)&&!Request::old('province'))? ($student->province=='Sabaragamuwa'?'selected':'') : (Request::old('province')=='Sabaragamuwa'?'selected':'') }}>Sabaragamuwa</option>
                                                        <option value="Uva" {{(isset($student)&&!Request::old('province'))? ($student->province=='Uva'?'selected':'') : (Request::old('province')=='Uva'?'selected':'') }}>Uva</option>
                                                        <option value="Western" {{(isset($student)&&!Request::old('province'))? ($student->province=='Western'?'selected':'') : (Request::old('province')=='Western'?'selected':'') }}>Western</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="shortname">iv. District</label>
                                                    <select id="district" name="district" class="form-control select2" required>
                                                        <option selected disabled>Select District</option>
                                                        @foreach($districts as $key=>$district)
                                                            <option value="{{$key}}" {{(isset($student)&&!Request::old('district'))? ($student->district==$district?'selected':'') : (Request::old('district')==$district?'selected':'') }}>{{$district}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="shortname">District No.</label>
                                                    <input value="{{isset($student)? $student->district_no : 0 }}" id="district_no" name="district_no" type="number" class="form-control bg-light" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nic">v. National Identity Card / Passport No. <span class="text-danger font-size-16">*</span> </label>
                                                    <input value="{{(isset($student)&&!Request::old('nic'))? $student->nic : Request::old('nic')}}" id="nic" name="nic" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile">vi. Mobile<span class="text-danger font-size-16">*</span> </label>
                                                    <input value="{{(isset($student)&&!Request::old('mobile'))? $student->mobile : Request::old('mobile')}}" id="mobile" name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="00947XXXXXXXX" required>
                                                    @error('mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">vii. Email <span class="text-danger font-size-16">*</span> </label>
                                                    <input value="{{(isset($student)&&!Request::old('email'))? $student->email : Request::old('email')}}" id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" required>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-dark text-light">
                                        3. Educational Qualifications
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="al_exam_year">i. Year of the G.C.E(A/L) Examination <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('al_exam_year'))? $student->al_exam_year : Request::old('al_exam_year')}}" id="al_exam_year" name="al_exam_year" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="al_index_number">ii. Index No. of the G.C.E(A/L) Examination <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('al_index_number'))? $student->al_index_number : Request::old('al_index_number')}}" id="al_index_number" name="al_index_number" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="al_z_score">iii. Average Z Score <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('al_z_score'))? $student->al_z_score : Request::old('al_z_score')}}" id="al_z_score" name="al_z_score" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="shortname">iv. G.C.E(A/L) Examination Results</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="subject_1">Subject</label>
                                                    <select id="subject_1" name="subjects[1][subject]" class="form-control select2" required>
                                                        <option disabled selected>Select Subject</option>
                                                        @foreach($al_subjects as $key=>$subject)
                                                            <option value="{{$key}}" {{(isset($subjects[0]['subject'])&&!Request::old('subjects[1][subject]'))? ($subjects[0]['subject']==$key?'selected':'') : (Request::old('subjects[1][subject]')==$key?'selected':'') }}>{{$subject}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="grade_1">Grade</label>
                                                    <select id="grade_1" name="subjects[1][grade]" class="form-control select2" required>
                                                        <option disabled selected>Select Grade</option>
                                                        @foreach($al_grades as $key=>$value)
                                                            <option value="{{$key}}" {{(isset($subjects[0]['grade'])&&!Request::old('subjects[1][grade]'))? ($subjects[0]['grade']==$key?'selected':'') : (Request::old('subjects[1][grade]')==$key?'selected':'') }}>{{$key}} ({{$value}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="subject_2">Subject</label>
                                                    <select id="subject_2" name="subjects[2][subject]" class="form-control select2" required>
                                                        <option disabled selected>Select Subject</option>
                                                        @foreach($al_subjects as $key=>$subject)
                                                            <option value="{{$key}}" {{(isset($subjects[1]['subject'])&&!Request::old('subjects[2][subject]'))? ($subjects[1]['subject']==$key?'selected':'') : (Request::old('subjects[2][name]')==$key?'selected':'') }}>{{$subject}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="grade_2">Grade</label>
                                                    <select id="grade_2" name="subjects[2][grade]" class="form-control select2" required>
                                                        <option disabled selected>Select Grade</option>
                                                        @foreach($al_grades as $key=>$value)
                                                            <option value="{{$key}}" {{(isset($subjects[1]['grade'])&&!Request::old('subjects[2][grade]'))? ($subjects[1]['grade']==$key?'selected':'') : (Request::old('subjects[2][grade]')==$key?'selected':'') }}>{{$key}} ({{$value}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="subject_3">Subject</label>
                                                    <select id="subject_3" name="subjects[3][subject]" class="form-control select2" required>
                                                        <option disabled selected>Select Subject</option>
                                                        @foreach($al_subjects as $key=>$subject)
                                                            <option value="{{$key}}" {{(isset($subjects[2]['subject'])&&!Request::old('subjects[3][subject]'))? ($subjects[2]['subject']==$key?'selected':'') : (Request::old('subjects[3][subject]')==$key?'selected':'') }}>{{$subject}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="grade_3">Grade</label>
                                                    <select id="grade_3" name="subjects[3][grade]" class="form-control select2" required>
                                                        <option disabled selected> Select Grade</option>
                                                        @foreach($al_grades as $key=>$value)
                                                            <option value="{{$key}}" {{(isset($subjects[2]['grade'])&&!Request::old('subjects[3][grade]'))? ($subjects[2]['grade']==$key?'selected':'') : (Request::old('subjects[3][grade]')==$key?'selected':'') }}>{{$key}} ({{$value}})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                       </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-dark text-light">
                                        4. Details of Citizenship
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name">i. Race <span class="text-danger font-size-16">*</span></label>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="S" type="radio" id="Sinhala" name="race" class="custom-control-input" {{(isset($student)&&!Request::old('race'))? ($student->race=='S'?'checked':'') : (Request::old('race')=='S'?'checked':'')}} onchange="raceHandleHide()" required>
                                                            <label class="custom-control-label" for="Sinhala">Sinhala</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="T" type="radio" id="Tamil" name="race" class="custom-control-input" {{(isset($student)&&!Request::old('race'))? ($student->race=='T'?'checked':'') : (Request::old('race')=='T'?'checked':'')}}  onchange="raceHandleHide()" required>
                                                            <label class="custom-control-label" for="Tamil">Tamil</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="M" type="radio" id="Muslim" name="race" class="custom-control-input" {{(isset($student)&&!Request::old('race'))? ($student->race=='M'?'checked':'') : (Request::old('race')=='M'?'checked':'')}}  onchange="raceHandleHide()" required>
                                                            <label class="custom-control-label" for="Muslim">Muslim</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="O" type="radio" id="RaceOthers" name="race" class="custom-control-input" onchange="raceHandleShow();" required>
                                                            <label class="custom-control-label" for="RaceOthers">Others</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline" id="RaceSpecifyShow">
                                                            <label for="RaceSpecify">Specify </label>
                                                            <input value="{{(isset($student)&&!Request::old('race'))? strlen($student->race)>1?$student->race:'' : Request::old('race')}}" type="text" id="RaceSpecify" name="RaceSpecify" class="ml-2 form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="shortname">ii. Gender <span class="text-danger font-size-16">*</span></label>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="M" type="radio" id="Male" name="gender" class="custom-control-input" {{(isset($student)&&!Request::old('gender'))? ($student->gender=='M'?'checked':'') : (Request::old('gender')=='M'?'checked':'')}}>
                                                            <label class="custom-control-label" for="Male">Male</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="F" type="radio" id="Female" name="gender" class="custom-control-input" {{(isset($student)&&!Request::old('gender'))? ($student->gender=='F'?'checked':'') : (Request::old('gender')=='F'?'checked':'')}}>
                                                            <label class="custom-control-label" for="Female">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shortname">iii. Civil Status <span class="text-danger font-size-16">*</span></label>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="S" type="radio" id="Single" name="civil_status" class="custom-control-input" {{(isset($student)&&!Request::old('civil_status'))? ($student->civil_status=='S'?'checked':'') : (Request::old('civil_status')=='S'?'checked':'')}}>
                                                            <label class="custom-control-label" for="Single">Single</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="M" type="radio" id="Married" name="civil_status" class="custom-control-input" {{(isset($student)&&!Request::old('civil_status'))? ($student->civil_status=='M'?'checked':'') : (Request::old('civil_status')=='M'?'checked':'')}}>
                                                            <label class="custom-control-label" for="Married">Married</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="shortname">iv. Religion <span class="text-danger font-size-16">*</span></label>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input onchange="religionHandleHide()" value="B" type="radio" id="Buddhist" name="religion" class="custom-control-input" {{(isset($student)&&!Request::old('religion'))? ($student->religion=='B'?'checked':'') : (Request::old('religion')=='B'?'checked':'')}}>
                                                            <label class="custom-control-label" for="Buddhist">Buddhist</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input onchange="religionHandleHide()" value="H" type="radio" id="Hindu" name="religion" class="custom-control-input" {{(isset($student)&&!Request::old('religion'))? ($student->religion=='H'?'checked':'') : (Request::old('religion')=='H'?'checked':'')}}>
                                                            <label class="custom-control-label" for="Hindu">Hindu</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input onchange="religionHandleHide()" value="C" type="radio" id="Christian" name="religion" class="custom-control-input" {{(isset($student)&&!Request::old('religion'))? ($student->religion=='C'?'checked':'') : (Request::old('religion')=='C'?'checked':'')}}>
                                                            <label class="custom-control-label" for="Christian">Christian</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input onchange="religionHandleHide()" value="I" type="radio" id="Islam" name="religion" class="custom-control-input" {{(isset($student)&&!Request::old('religion'))? ($student->religion=='I'?'checked':'') : (Request::old('religion')=='I'?'checked':'')}}>
                                                            <label class="custom-control-label" for="Islam">Islam</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input onchange="religionHandleShow()" value="O" type="radio" id="religionOthers" name="religion" class="custom-control-input" {{(isset($student)&&!Request::old('religion'))? ($student->religion=='O'?'checked':'') : (Request::old('religion')=='O'?'checked':'')}}>
                                                            <label class="custom-control-label" for="religionOthers">Others</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline" id="religionSpecifyShow">
                                                            <label for="religionSpecify">Specify </label>
                                                            <input value="{{(isset($student)&&!Request::old('religion'))? strlen($student->religion)>1?$student->religion:'' : Request::old('religion')}}"  type="text" id="religionSpecify" name="religionSpecify" class="ml-2 form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="date_of_birth">v. Date of Birth <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('date_of_birth'))? $student->date_of_birth : Request::old('date_of_birth')}}" id="date_of_birth" name="date_of_birth" type="date" class="form-control" placeholder="yyyy-mm-dd" onchange="calculateAge()">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="date_of_birth">Age</label>
                                                <input type="text" id="age" name="age" class="ml-2 form-control bg-light"  readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="citizenship">vii. Citizenship <span class="text-danger font-size-16">*</span></label>
                                                    <select id="citizenship" name="citizenship" class="form-control select2" required>
                                                        <option selected disabled>--Select--</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country}}" {{(isset($student)&&!Request::old('citizenship'))? ($student->citizenship==$country?'selected':'') : (Request::old('citizenship')==$country?'selected':'') }}>{{$country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="IfSriLankan">
                                                <div class="form-group">
                                                    <label for="shortname">If Sri Lankan</label>
                                                    <div class="form-control">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="By Descent" type="radio" id="Descent" name="citizenship_type" class="custom-control-input" {{(isset($student)&&!Request::old('citizenship_type'))? ($student->citizenship_type=="By Descent"?'checked':'') : (Request::old('citizenship_type')=="By Descent"?'checked':'') }}>
                                                            <label class="custom-control-label" for="Descent">By Descent</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input value="By Registration" type="radio" id="Registration" name="citizenship_type" class="custom-control-input" {{(isset($student)&&!Request::old('citizenship_type'))? ($student->citizenship_type=="By Registration"?'checked':'') : (Request::old('citizenship_type')=="By Registration"?'checked':'') }}>
                                                            <label class="custom-control-label" for="Registration">By Registration</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-dark text-light">
                                        5. Details of Parents / Guardian
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="parent_full_name">i. Full name of Father / Mother / Guardian <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('parent_full_name'))? $student->parent_full_name : Request::old('parent_full_name')}}" id="parent_full_name" name="parent_full_name" type="text" class="form-control @error('parent_full_name') is-invalid @enderror">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="parent_occupation">ii. Occupation <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('parent_occupation'))? $student->parent_occupation : Request::old('parent_occupation')}}" id="parent_occupation" name="parent_occupation" type="text" class="form-control @error('parent_occupation') is-invalid @enderror">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="parent_address_work">iii. Address of the &nbsp;place of work</label>
                                                    <input value="{{(isset($student)&&!Request::old('parent_address_work'))? $student->parent_address_work : Request::old('parent_address_work')}}" id="parent_address_work" name="parent_address_work" type="text" class="form-control @error('parent_address_work') is-invalid @enderror">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="parent_landline">iv. Telephone No. (Landline)</label>
                                                    <input placeholder="0094XXXXXXXXX" value="{{(isset($student)&&!Request::old('parent_landline'))? $student->parent_landline : Request::old('parent_landline')}}" id="parent_landline" name="parent_landline" type="text" class="form-control @error('parent_landline') is-invalid @enderror">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="parent_mobile">Telephone No. (Mobile) <span class="text-danger font-size-16">*</span></label>
                                                    <input placeholder="0094XXXXXXXXX" value="{{(isset($student)&&!Request::old('parent_mobile'))? $student->parent_mobile : Request::old('parent_mobile')}}" id="parent_mobile" name="parent_mobile" type="text" class="form-control @error('parent_mobile') is-invalid @enderror">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emergency_contact_name">v. Name of the person to be informed in case of an Emergency <span class="text-danger font-size-16">*</span></label>
                                                    <input value="{{(isset($student)&&!Request::old('emergency_contact_name'))? $student->emergency_contact_name : Request::old('emergency_contact_name')}}" id="emergency_contact_name" name="emergency_contact_name" type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emergency_contact_mobile">Telephone no of the person to be informed in case of an Emergency <span class="text-danger font-size-16">*</span></label>
                                                    <input placeholder="0094XXXXXXXXX" value="{{(isset($student)&&!Request::old('emergency_contact_mobile'))? $student->emergency_contact_mobile : Request::old('emergency_contact_mobile')}}" id="emergency_contact_mobile" name="emergency_contact_mobile" type="text" class="form-control @error('emergency_contact_mobile') is-invalid @enderror">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col text-right">
                                        <button  type="submit" class="btn btn-primary"><i class="mdi mdi-content-save-outline mr-1"></i>  Save </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if(isset($enroll))
                            <div class="card">
                                <div class="card-header bg-dark text-light">
                                    Identity Card Image
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8" >
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="text-dark">
                                                        <div>Image must be a file of type of jpeg, jpg and may not be greater than 5120 kilobytes (5MB).
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body bg-light">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <label>Your recent photograph (Identity Card Image) <span class="text-danger font-size-16">*</span></label>
                                                            <input type="hidden" name="student_id"  id="document_student_id" value="{{$student->id}}">
                                                            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="profileImage">
                                                            <div class="alert  p-3">
                                                                <div class="h6 text-primary"><i class="mdi mdi-information"></i> Identity Card Image should be: </div>
                                                                <div>Required photo size: Passport Size</div>
                                                                <div>The submitted photos must be in color</div>
                                                                <div> Head position: straight</div>
                                                                <div>Background: Blue/Light Blue</div>
                                                                <div>Recency: taken no more than 6 months ago</div>
                                                                <div>Eyes: must be clearly visible</div>
                                                                <div>Blurred pictures will be rejected</div>
                                                                <div>Dress code: the colors of your clothes must be in contrast with the background. Do not wear Blue/Light Blue tops</div>
                                                            </div>
                                                            @error('image')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        <div class="card">
                            <div class="card-header bg-dark text-light">
                                Documents
                            </div>
                            <div class="card-body">
                                <form action="{{ route('student.registration.image.upload') }}" method="POST" enctype="multipart/form-data" id="document-upload">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <div class="card">
                                                <div class="card-header bg-soft-info">
                                                    <div class="text-primary">
                                                        <div>Each image must be a file of type of jpeg, jpg and may not be greater than 5120 kilobytes (5MB).
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body bg-light">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Selection Letter sent by the UGC <span class="text-danger font-size-16">*</span></label>
                                                            <input type="hidden" name="student_id" value="{{$student->id}}">
                                                            <input type="file" name="ugc" class="form-control  @error('ugc') is-invalid @enderror">
                                                            @error('ugc')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                             </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

{{--                                                <div class="card-body bg-light">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-12 mt-3">--}}
{{--                                                            <label>Your recent photograph (Identity Card Image) <span class="text-danger font-size-16">*</span></label>--}}
{{--                                                            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">--}}
{{--                                                            <div class="alert  p-3">--}}
{{--                                                                <div class="h6 text-primary"><i class="mdi mdi-information"></i> Identity Card Image should be: </div>--}}
{{--                                                                <div>Required photo size: Passport Size</div>--}}
{{--                                                                <div>The submitted photos must be in color</div>--}}
{{--                                                                <div> Head position: straight</div>--}}
{{--                                                                <div>Background: Blue/Light Blue</div>--}}
{{--                                                                <div>Recency: taken no more than 6 months ago</div>--}}
{{--                                                            </div>--}}
{{--                                                            @error('image')--}}
{{--                                                            <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                                            @enderror--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Paid Bank Voucher <span class="text-danger font-size-16">*</span></label>
                                                            <input type="file" name="bank" class="form-control  @error('bank') is-invalid @enderror">
                                                            @error('bank')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body bg-light">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <label>Student Record Sheet (School Leaving Certificate)  <span class="text-danger font-size-16">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Front Side</label>
                                                            <input type="file" name="lc_f" class="form-control  @error('lc_f') is-invalid @enderror">
                                                            @error('lc_f')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Back side </label>
                                                            <input type="file" name="lc_b" class="form-control  @error('lc_b') is-invalid @enderror">
                                                            @error('lc_b')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <label>National Identity Card(NIC) / Passport  <span class="text-danger font-size-16">*</span></label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Front side</label>
                                                            <input type="file" name="nic_f" class="form-control  @error('nic_f') is-invalid @enderror">
                                                            @error('nic_f')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Back side</label>
                                                            <input type="file" name="nic_b" class="form-control  @error('nic_b') is-invalid @enderror">
                                                            @error('nic_b')
                                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-block btn-primary"><i class="mdi mdi-upload-multiple"></i> Upload</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($enroll->student->student_docs()->count()>0)
                                            <div class="col-md-6" >
                                                <div class="card">
                                                    <div class="card-header bg-success text-light"><i class="mdi mdi-check-circle"></i> Files has been uploaded</div>
                                                    <div class="card-body">
                                                        <div class="zoom-gallery">
                                                            <div class="row">
                                                                @foreach($enroll->student->student_docs()->get() as $doc)
                                                                    @if(Storage::disk('docs')->exists($doc->name))
                                                                        <div class="col-md-3 text-center">
{{--                                                                            <div class="font-size-12">{{$doc->name}}</div>--}}
                                                                            <a  href="/registration/student/image/{{$doc->name}}" title="{{$doc->name}}"><img src="/registration/student/image/{{$doc->name}}" alt="{{$doc->type}}" class="img-thumbnail img-fluid" width="150" ></a>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>


{{--    //model--}}

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/5129701">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop"><i class="mdi mdi-crop"></i> Crop and Upload</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <!-- Magnific Popup-->
    <script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>
    <!-- lightbox init js-->
    <script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(".select2").select2();
        var _token = "{{ csrf_token() }}";
    </script>
    <script>
        if(!$('#RaceOthers').is(':checked')){
            document.getElementById('RaceSpecifyShow').style.visibility='hidden';
        }
        @if(isset($student) && strlen($student->race)>1)
        document.getElementById('RaceSpecifyShow').style.visibility='visible';
        $('#RaceOthers').prop("checked", true);
        @endif

        if(!$('#religionOthers').is(':checked')){
            document.getElementById('religionSpecifyShow').style.visibility='hidden';
        }
        @if(isset($student) && strlen($student->religion)>1)
        document.getElementById('religionSpecifyShow').style.visibility='visible';
        $('#religionOthers').prop("checked", true);
        @endif


        function raceHandleShow() {
            document.getElementById('RaceSpecifyShow').style.visibility='visible';
        }
        function raceHandleHide() {
            document.getElementById('RaceSpecifyShow').style.visibility='hidden';
        }
        function religionHandleShow() {
            document.getElementById('religionSpecifyShow').style.visibility='visible';
        }
        function religionHandleHide() {
            document.getElementById('religionSpecifyShow').style.visibility='hidden';
        }

        function calculateAge() {
            var birthday = new Date(document.getElementById('date_of_birth').value);
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch

            document.getElementById('age').value = Math.abs(ageDate.getUTCFullYear() - 1970) +' years';
        }
        calculateAge();

        $('#district').on('change', function() {
           $('#district_no').val($('#district').val());
        });
        //countr
        document.getElementById('IfSriLankan').style.visibility='hidden';
        $('#citizenship').on('change', function() {
            if(this.value=='Sri Lanka'){
                document.getElementById('IfSriLankan').style.visibility='visible';
            }else{
                document.getElementById('IfSriLankan').style.visibility='hidden';
                $('#Descent').prop("checked", false);
                $('#Registration').prop("checked", false);
            }

        })

        @if(isset($student) && $student->citizenship=="Sri Lanka")
        document.getElementById('IfSriLankan').style.visibility='visible';
        @endif
    </script>

    <script src="{{ URL::asset('assets/js/pages/generate.reg.no.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/cropperjs/cropperjs.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/photograph.upload.js')}}"></script>
@endsection
