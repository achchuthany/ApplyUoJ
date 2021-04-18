<form class="needs-validation" method="POST" action="{{ route('student.address.process') }}">
    {{ csrf_field() }}
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
                            <option value="{{$country}}" {{(isset($address_p)&&!Request::old('address_country'))? ($address_p->address_country==$country?'selected':($country=='Sri Lanka'?'selected':'')) : (Request::old('address_country')==$country?'selected':($country=='Sri Lanka'?'selected':'')) }}>{{$country}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address_postal_code">Address Postal Code</label>
                    <input value="{{(isset($address_p)&&!Request::old('address_postal_code'))? $address_p->address_postal_code : Request::old('address_postal_code')}}" id="address_postal_code" name="address[P][address_postal_code]" type="text" class="form-control" pattern="^[0-9]{4,10}$">
                </div>
            </div>
        </div>
        <label for="name" class="mt-4 font-weight-bold">ii. Contact Address</label>
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
                            <option value="{{$country}}" {{(isset($address_c)&&!Request::old('address_country'))? ($address_c->address_country==$country?'selected':($country=='Sri Lanka'?'selected':'')) : (Request::old('address_country')==$country?'selected':($country=='Sri Lanka'?'selected':'')) }}>{{$country}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address_postal_code">Address Postal Code</label>
                    <input value="{{(isset($address_c)&&!Request::old('address_postal_code'))? $address_c->address_postal_code : Request::old('address_postal_code')}}" id="address_postal_code" name="address[C][address_postal_code]" type="text" class="form-control" pattern="^[0-9]{4,10}$">
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
                    <input value="{{$student->district}}" id="district" name="district" type="text" class="form-control bg-light" disabled>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="shortname">District No.</label>
                    <input value="{{$student->district_no}}" id="district_no" name="district_no" type="text" class="form-control bg-light" disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nic">v. National Identity Card / Passport No. <span class="text-danger font-size-16">*</span> </label>
                    <input value="{{$student->nic}}" id="nic" name="nic" type="text" class="form-control bg-light" disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile">vi. Mobile<span class="text-danger font-size-16">*</span> </label>
                    <input value="{{(isset($student)&&!Request::old('mobile'))? $student->mobile : Request::old('mobile')}}" id="mobile" name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" pattern="^[0-9]{9,10}$" required>
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
                    <input value="{{(isset($student)&&!Request::old('email'))? $student->email : Request::old('email')}}" id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror bg-light" readonly>
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
    <div class="row mt-4">
        <div class="col">
            <a href="{{route('student.personal')}}" class="btn btn-light"><i class="mdi mdi-arrow-left mr-1"></i> Back</a>
        </div>
        <div class="col text-right">
            <button  type="submit" class="btn btn-primary">  Next <i class="mdi mdi-arrow-right mr-1"></i></button>
        </div> <!-- end col -->
    </div> <!-- end row-->
</form>
