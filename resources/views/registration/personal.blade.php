<form class="needs-validation" method="POST" action="{{ route('student.personal.process') }}">
    {{ csrf_field() }}
<div class="card">
    <div class="card-header bg-dark text-light">
        Course Details
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Course">Name of the Course of Study</label>
                    <input value="{{$enroll->programme->name}}" id="Course" name="Course" type="text" class="form-control bg-light" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="shortname">Faculty</label>
                    <input value="{{$enroll->programme->faculty->name}}" id="abbreviation" name="abbreviation" type="text" class="form-control bg-light" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="shortname">Registration No</label>
                    <input value="{{$enroll->reg_no}}" id="abbreviation" name="abbreviation" type="text" class="form-control bg-light" disabled>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
{{--                                end card--}}
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
                    <label for="name_initials">iii. Name with Initials</label>
                    <input value="{{(isset($student)&&!Request::old('name_initials'))? $student->name_initials : Request::old('name_initials')}}" id="name_initials" name="name_initials" type="text" class="form-control bg-light" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="full_name">iv. Full Name</label>
                    <input value="{{(isset($student)&&!Request::old('full_name'))? $student->full_name : Request::old('full_name')}}" id="full_name" name="full_name" type="text" class="form-control bg-light" disabled>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
<div class="row mt-4">
    <div class="col text-right">
        <button  type="submit" class="btn btn-primary">  Next <i class="mdi mdi-arrow-right mr-1"></i></button>
    </div> <!-- end col -->
</div> <!-- end row-->
</form>
