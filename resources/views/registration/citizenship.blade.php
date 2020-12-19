<form class="needs-validation" method="POST" action="{{ route('student.citizenship.process') }}">
    {{ csrf_field() }}
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
                            <input value="S" type="radio" id="Sinhala" name="race" class="custom-control-input" {{(isset($student)&&!Request::old('race'))? ($student->race=='S'?'checked':'') : (Request::old('race')=='S'?'checked':'')}} onchange="raceHandleHide()">
                            <label class="custom-control-label" for="Sinhala">Sinhala</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input value="T" type="radio" id="Tamil" name="race" class="custom-control-input" {{(isset($student)&&!Request::old('race'))? ($student->race=='T'?'checked':'') : (Request::old('race')=='T'?'checked':'')}}  onchange="raceHandleHide()">
                            <label class="custom-control-label" for="Tamil">Tamil</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input value="M" type="radio" id="Muslim" name="race" class="custom-control-input" {{(isset($student)&&!Request::old('race'))? ($student->race=='M'?'checked':'') : (Request::old('race')=='M'?'checked':'')}}  onchange="raceHandleHide()">
                            <label class="custom-control-label" for="Muslim">Muslim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input value="O" type="radio" id="RaceOthers" name="race" class="custom-control-input" onchange="raceHandleShow();">
                            <label class="custom-control-label" for="RaceOthers">Others</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline" id="RaceSpecifyShow">
                            <label for="RaceSpecify">Specify </label>
                            <input value="{{(isset($student)&&!Request::old('race'))? strlen($student->race)>1?$student->race:'' : Request::old('race')}}" type="text" id="RaceSpecify" name="RaceSpecify" class="ml-2 form-control form-control-sm">

                        </div>
                    </div>
                </div>
            </div>
            <script>

            </script>
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
                    <input value="{{(isset($student)&&!Request::old('date_of_birth'))? $student->date_of_birth : Request::old('date_of_birth')}}" id="date_of_birth" name="date_of_birth" type="date" class="form-control" placeholder="yyyy-mm-dd" onchange="
                    calculateAge()">
                </div>
            </div>
            <div class="col-md-6">
                <label for="date_of_birth">Age</label>
                <input type="text" id="age" name="age" class="ml-2 form-control bg-soft-secondary"  readonly>
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
<div class="row mt-4">
    <div class="col">
        <a href="{{route('student.education')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
    </div>
    <div class="col text-right">
        <button  type="submit" class="btn btn-primary">  Next <i class="mdi mdi-arrow-right mr-1"></i></button>
    </div> <!-- end col -->
</div> <!-- end row-->
</form>

