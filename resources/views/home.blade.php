@extends('layouts.master-dark-sidebar')
@section('title')
    Students Statistics
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Home @endslot
        @slot('title') Students Statistics @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header h6">
                    Students Statistics by Programme
                    <span class="float-right">Academic Year
                        <select  id="ay">
                            @foreach($ays as $ay)
                                <option value="{{$ay->id}}">{{$ay->name}}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="card-body">
                    <canvas id="bar" height="110"></canvas>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/chart-js/chart-js.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/pages/chartjs.init.js')}}"></script>
@endsection
