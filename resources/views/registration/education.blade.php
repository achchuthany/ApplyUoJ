<form class="needs-validation" method="POST" action="{{ route('student.education.process') }}">
    {{ csrf_field() }}
<div class="card">
    <div class="card-header bg-dark text-light">
        3. Educational Qualifications
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="al_exam_year">i. Year of the G.C.E(A/L) Examination <span class="text-danger font-size-16">*</span></label>
                    <input value="{{$student->al_exam_year}}" id="al_exam_year" name="al_exam_year" type="text" class="form-control" pattern="^[0-9]{4}" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="shortname">ii. Index No. of the G.C.E(A/L) Examination <span class="text-danger font-size-16">*</span></label>
                    <input value="{{$student->al_index_number }}" id="abbreviation" name="abbreviation" type="text" class="form-control bg-light" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="shortname">iii. Average Z Score <span class="text-danger font-size-16">*</span></label>
                    <input value="{{$student->al_z_score}}" id="abbreviation" name="abbreviation" type="text" class="form-control bg-light" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <label for="shortname">iv. G.C.E(A/L) Examination Results</label>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="subject_1">Subject</label>
                    <select id="subject_1" name="subjects[1][subject]" class="form-control select2" required>
                        <option disabled selected>-- Select --</option>
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
                        <option disabled selected>-- Select --</option>
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
                        <option disabled selected>-- Select --</option>
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
                        <option disabled selected>-- Select --</option>
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
                        <option disabled selected>-- Select --</option>
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
                        <option disabled selected>-- Select --</option>
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
<div class="row mt-4">
    <div class="col">
        <a href="{{route('student.address')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
    </div>
    <div class="col text-right">
        <button  type="submit" class="btn btn-primary">  Next <i class="mdi mdi-arrow-right mr-1"></i></button>
    </div> <!-- end col -->
</div> <!-- end row-->
</form>

