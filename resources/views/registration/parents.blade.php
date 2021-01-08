<form class="needs-validation" method="POST" action="{{ route('student.parents.process') }}">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-header bg-dark text-light">
            5. Details of Parents / Guardian
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="parent_full_name">i. Full name of Father / Mother / Guardian <span class="text-danger font-size-16">*</span></label>
                        <input value="{{(isset($student)&&!Request::old('parent_full_name'))? $student->parent_full_name : Request::old('parent_full_name')}}" id="parent_full_name" name="parent_full_name" type="text" class="form-control @error('parent_full_name') is-invalid @enderror" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="parent_occupation">ii. Occupation <span class="text-danger font-size-16">*</span></label>
                        <input value="{{(isset($student)&&!Request::old('parent_occupation'))? $student->parent_occupation : Request::old('parent_occupation')}}" id="parent_occupation" name="parent_occupation" type="text" class="form-control @error('parent_occupation') is-invalid @enderror" required>
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
                        <input value="{{(isset($student)&&!Request::old('parent_landline'))? $student->parent_landline : Request::old('parent_landline')}}" id="parent_landline" name="parent_landline" type="text" class="form-control @error('parent_landline') is-invalid @enderror" pattern="^[0-9]{9,10}$" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="parent_mobile">Telephone No. (Mobile) <span class="text-danger font-size-16">*</span></label>
                        <input value="{{(isset($student)&&!Request::old('parent_mobile'))? $student->parent_mobile : Request::old('parent_mobile')}}" id="parent_mobile" name="parent_mobile" type="text" class="form-control @error('parent_mobile') is-invalid @enderror" pattern="^[0-9]{9,10}$" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emergency_contact_name">v. Name of the person to be informed in case of an Emergency <span class="text-danger font-size-16">*</span></label>
                        <input value="{{(isset($student)&&!Request::old('emergency_contact_name'))? $student->emergency_contact_name : Request::old('emergency_contact_name')}}" id="emergency_contact_name" name="emergency_contact_name" type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emergency_contact_mobile">Telephone no of the person to be informed in case of an Emergency <span class="text-danger font-size-16">*</span></label>
                        <input value="{{(isset($student)&&!Request::old('emergency_contact_mobile'))? $student->emergency_contact_mobile : Request::old('emergency_contact_mobile')}}" id="emergency_contact_mobile" name="emergency_contact_mobile" type="text" pattern="^[0-9]{9,10}$" class="form-control @error('emergency_contact_mobile') is-invalid @enderror" required>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    {{--end card--}}
    <div class="row mt-4">
        <div class="col">
            <a href="{{route('student.citizenship')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
        </div>
        <div class="col text-right">
            <button  type="submit" class="btn btn-primary">  Next <i class="mdi mdi-arrow-right mr-1"></i></button>
        </div> <!-- end col -->
    </div> <!-- end row-->
</form>
