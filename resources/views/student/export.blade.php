@extends('layouts.master-dark-sidebar')
@section('title')
    Export Students
@endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Students @endslot
        @slot('title') Export @endslot
    @endcomponent
    <form method="post" action="{{route('admin.students.export')}}">
        @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Export Student Data as CSV File</h5>
                </div>
                <div class="card-body">
                    <div class="row g-5">
                        <div class="col-md-6">
                            <div>
                                <select name="programme_id[]" id="programme_id" class="select2 form-control select2-multiple" multiple="multiple"  data-placeholder="Select Programme(s) ...">
                                    @foreach($programmes as $ay)
                                        <option value="{{$ay->id}}">{{$ay->name}}</option>
                                    @endforeach
                                </select>
                                <div class="badge badge-soft-primary p-2 float-right" id="select_all" ><i class="mdi mdi-select-all"></i> Select All </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <select name="academic_year_id[]" id="academic_year_id" class="select2 form-control select2-multiple" multiple="multiple"  data-placeholder="Select Academic Year(s) ...">
                                    @foreach($academic_years as $ay)
                                        <option value="{{$ay->id}}">{{$ay->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <select name="status[]" id="enroll_status" class="select2 form-control select2-multiple" multiple="multiple"  data-placeholder="Enroll Statues(es) ...">
                                    @foreach($enroll_status as $ay=>$name)
                                        <option value="{{$name}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <select name="columns[]" id="columns" class="select2 form-control select2-multiple" multiple="multiple"  data-placeholder="Select Student Attribute(s)">
                                <option value="students.title">1. Title</option>
                                <option value="students.name_initials">2. Name with Initials</option>
                                <option value="students.full_name">3. Full Name</option>
                                <option value="students.province">4. Province</option>
                                <option value="students.district">5. District</option>
                                <option value="students.nic">6. NIC Number</option>
                                <option value="students.mobile">7. Mobile</option>
                                <option value="students.email">8. E-Mail</option>
                                <option value="students.al_index_number">9. AL Index Number</option>
                                <option value="students.al_exam_year">10. AL Exam Year</option>
                                <option value="students.al_z_score">11. AL Z Score</option>
                                <option value="students.al_english_mark">12. AL English Marks</option>
                                <option value="students.race">13. Race</option>
                                <option value="students.gender">14. Gender</option>
                                <option value="students.civil_status">15. Civil Status</option>
                                <option value="students.religion">16. Religion</option>
                                <option value="students.medium">17. Medium</option>
                                <option value="students.date_of_birth">18. Date of Birth</option>
                                <option value="students.citizenship">19. Citizenship</option>
                                <option value="students.citizenship_type">20. Citizenship Type</option>
                                <option value="enrolls.reg_no">21. Registration Number</option>
                                <option value="enrolls.index_no">22. Index Number</option>
                                <option value="programmes.name">23. Programme Name</option>
                            </select>
                            <div class="badge badge-soft-primary p-2 float-right" id="columns_select_all" ><i class="mdi mdi-select-all"></i> Select All </div>

                        </div>
                        <div class="col-md-2">
                            <div>
                                <button class="btn btn-primary"  type="submit"> Export </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="row mb-1">
        <div class="col-xl-12">
            <form method="post" action="{{route('admin.students.export.image')}}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Export Student's Uploaded Images</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-5">
                                    <div class="col-md-5">
                                        <div>
                                            <select name="programme_id" id="programme_id_2" class="select2 form-control" data-placeholder="Select Programme ...">
                                                @foreach($programmes as $ay)
                                                    <option value="{{$ay->id}}" {{old('programme_id')==$ay->id?'selected':''}}>{{$ay->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <select name="academic_year_id" id="academic_year_id_2" class="select2 form-control" data-placeholder="Select Academic Year ...">
                                                @foreach($academic_years as $ay)
                                                    <option value="{{$ay->id}}" {{old('academic_year_id')==$ay->id?'selected':''}}>{{$ay->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <select name="type" id="type" class="select2 form-control" data-placeholder="Select Document Type ...">
                                                <option value="photo" {{old('type')=='photo'?'selected':''}}>Profile Image</option>
                                                <option value="SIGN" {{old('type')=='SIGN'?'selected':''}}>Student Signature</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <button class="btn btn-primary"  type="submit"> Export </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
        $('#select_all').on('click',function(){
            $("#programme_id > option").prop("selected", "selected");
            $("#programme_id").trigger("change");
        });
        $('#columns_select_all').on('click',function(){
            $("#columns > option").prop("selected", "selected");
            $("#columns").trigger("change");
        });
    </script>
@endsection
