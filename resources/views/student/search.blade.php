@extends('layouts.master-dark-sidebar')
@section('title')
    Students Search
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Student @endslot
        @slot('title') Search Students  @endslot
    @endcomponent
    <div class="row justify-content-center align-items-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">List of Students by Programme</div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="{{ route('admin.students.search.list') }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="programme_id">Programme Title</label>
                                    <select class="form-control select2" name="programme_id" required>
                                        @foreach($programmes as $programme)
                                            <option value="{{$programme->id}}" >{{$programme->name.' - '.$programme->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="academic_year_id">Academic Year</label>
                                    <select class="form-control select2" name="academic_year_id" required>
                                        @foreach($academics as $academic)
                                            <option value="{{$academic->id}}">{{$academic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Enroll Status</label>
                                    <select class="form-control select2" name="status" required>
                                        <option value="all" selected>All</option>
                                        @foreach($params as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group pt-1">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i> List
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
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
    </script>
@endsection
