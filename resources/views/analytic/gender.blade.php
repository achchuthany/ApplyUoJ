@extends('layouts.master-dark-sidebar')
@section('title')
    Students' Analytics of Gender and Civil Status
@endsection

@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Analytics @endslot
        @slot('title') Analytics of Students' Gender and Civil Status @endslot
    @endcomponent
    @include('analytic.select')
    <div class="row">
        <div class="col-xl-8">
            <div data-simplebar style="max-height: 500px;">
                <div class="card" style="min-height: 430px;">
                    <div class="card-body">
                        <div class="card-title">Analytics of Students' Gender</div>
                        <canvas id="gender_chart" ></canvas>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-xl-4">
            <div data-simplebar style="max-height: 500px;">
                <div class="card" style="min-height: 430px;">
                    <div class="card-body">
                        <div class="card-title">Analytics of Students' Gender</div>
                        <div class="table-responsive">
                            <table id="datatable"  class="table table-hover table-striped">
                                <thead>
                                <th>Race</th>
                                <th>No. of Students</th>
                                <th>Percentage</th>

                                </thead>
                                <tbody id="gender_table_data" >
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
                        <div class="card-title">Analytics of Students' Civil Status</div>
                        <canvas id="civil_chart" ></canvas>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-xl-4">
            <div data-simplebar style="max-height: 500px;">
                <div class="card" style="min-height: 430px;">
                    <div class="card-body">
                        <div class="card-title">Analytics of Students' Civil Status</div>
                        <div class="table-responsive">
                            <table id="datatable"  class="table table-hover table-striped">
                                <thead>
                                <th>Religion</th>
                                <th>No. of Students</th>
                                <th>Percentage</th>

                                </thead>
                                <tbody id="civil_table_data" >
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
        var url = "{{route('admin.analytics.getGenderData')}}";
        var _token = "{{csrf_token()}}";
    </script>
    <script src="{{URL::asset('assets/js/pages/chart_gender.init.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>


@endsection
