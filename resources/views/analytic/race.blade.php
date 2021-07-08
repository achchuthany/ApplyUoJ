@extends('layouts.master-dark-sidebar')
@section('title')
    Students' Analytics of Race
@endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Analytics @endslot
        @slot('title') Analytics of Students' Race and Religion @endslot
    @endcomponent

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

    <div class="row">
        <div class="col-xl-8">
            <div data-simplebar style="max-height: 500px;">
                <div class="card" style="min-height: 430px;">
                    <div class="card-body">
                        <div class="card-title">Analytics of Students' Race</div>
                        <canvas id="pie" ></canvas>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-xl-4">
            <div data-simplebar style="max-height: 500px;">
                <div class="card" style="min-height: 430px;">
                    <div class="card-body">
                        <div class="card-title">Analytics of Students' Race</div>
                        <div class="table-responsive">
                            <table id="datatable"  class="table table-hover table-striped">
                                <thead>
                                <th>Race</th>
                                <th>No. of Students</th>
                                <th>Percentage</th>

                                </thead>
                                <tbody id="table_data" >
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->



    <div class="row">
        <div class="col-xl-8">
            <div data-simplebar style="max-height: 500px;">
                <div class="card" style="min-height: 430px;">
                    <div class="card-body">
                        <div class="card-title">Analytics of Students' Religion</div>
                        <canvas id="religion_chart" ></canvas>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-xl-4">
            <div data-simplebar style="max-height: 500px;">
                <div class="card" style="min-height: 430px;">
                    <div class="card-body">
                        <div class="card-title">Analytics of Students' Religion</div>
                        <div class="table-responsive">
                            <table id="datatable"  class="table table-hover table-striped">
                                <thead>
                                <th>Religion</th>
                                <th>No. of Students</th>
                                <th>Percentage</th>

                                </thead>
                                <tbody id="religion_table_data" >
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/chart-js/chart-js.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
        var url = "{{route('admin.analytics.getRaceData')}}";
        var _token = "{{csrf_token()}}";
    </script>
    <script src="{{URL::asset('assets/js/pages/chart_race.init.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>


@endsection
