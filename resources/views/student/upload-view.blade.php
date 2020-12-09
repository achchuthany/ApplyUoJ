@extends('layouts.master-dark-sidebar')
@section('title')
    Students Bulk Upload View : {{$programme->name}}
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/rwd-table/rwd-table.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') MACOSIS @endslot
    @slot('title') Students Bulk Upload View : {{$programme->abbreviation}}@endslot
@endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Step 2: Check CSV data before Upload</h4>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <h6>Programme : <span class="text-primary">{{$programme->name}}</span> </h6>
                        </div>
                        <div class="col-md-3">
                            <h6>Type : <span class="text-primary">{{$programme->type}}</span> </h6>
                        </div>
                        <div class="col-md-3">
                           <h6> Academic : <span class="text-primary"> {{$academic->name}}</span></h6>
                        </div>
                    </div>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table">
                                <thead>
                                <tr class="text-uppercase">
                                    <th data-priority="1">ID</th>
                                    <th data-priority="2">Data</th>
                                @foreach ($csv_header[0] as $key => $value)
                                        <th data-priority="{{$key}}">{{$value}}</th>
                                @endforeach
                                </tr>


                                </thead>
                                <tbody>
                                <span {{$i=1}} hidden></span>
                                @foreach ($csv_data as $row)
                                    <tr>
                                        <th>{{ $i++ }}</th>
                                        @foreach ($row as $key => $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ route('admin.students.upload.process') }}">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="header" class="custom-control-input" id="invalidCheck" required>
                                    <label class="custom-control-label h6 text-primary" for="invalidCheck">I have read and agree to the datas are correct</label>
                                    <div class="invalid-feedback">
                                        You must agree before submitting.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                           <a href="{{route('admin.students.upload')}}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back</a>
                                {{ csrf_field() }}
                                <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                                <input type="hidden" name="programme_id" value="{{ $programme->id }}" />
                                <input type="hidden" name="academic_year_id" value="{{ $academic->id }}" />
                                <button type="submit" class="btn btn-primary float-right">
                                    <i class="fas fa-cloud-upload-alt"></i> Import Data
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/rwd-table/rwd-table.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/table-responsive.init.js')}}"></script>
@endsection
