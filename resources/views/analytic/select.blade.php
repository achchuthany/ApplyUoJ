<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-0">
                            <select name="programme_id[]" id="programme_id" class="select2 form-control select2-multiple" multiple="multiple"  data-placeholder="Select Programme(s) ...">
                                @foreach($programmes as $ay)
                                    <option value="{{$ay->id}}">{{$ay->name}}</option>
                                @endforeach
                            </select>
                            <div class="badge badge-soft-primary p-2 float-right" id="select_all" ><i class="mdi mdi-select-all"></i> Select All </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-0">
                            <select name="academic_year_id[]" id="academic_year_id" class="select2 form-control select2-multiple" multiple="multiple"  data-placeholder="Select Academic Year(s) ...">
                                @foreach($academic_years as $ay)
                                    <option value="{{$ay->id}}">{{$ay->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-0">
                            <select name="enroll_status[]" id="enroll_status" class="select2 form-control select2-multiple" multiple="multiple"  data-placeholder="Enroll Statues(es) ...">
                                @foreach($enroll_status as $ay=>$name)
                                    <option value="{{$name}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-0">
                            <button class="btn btn-primary" id="apply"> Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
