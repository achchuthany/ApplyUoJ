@extends('layouts.master-dark-sidebar')
@section('title')
    Students
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Student @endslot
        @slot('title') List of Students @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">UGC Student's List <span class="float-right text-light"><a href="{{route('admin.students.all')}}" class="btn-link"><i class="fas fa-list"></i> View All</a> </span></div>
                <div class="card-body table-info">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter text-info"><span data-plugin="counterup">{{$count['ugc']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total Students</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Registration Pending Students <span class="float-right text-light"><a href="{{route('admin.students.pending')}}" class="btn-link"><i class="fas fa-list"></i> View All</a> </span></div>
                <div class="card-body table-warning">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter text-warning"><span data-plugin="counterup">{{$count['pending_today']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter text-warning"><span data-plugin="counterup">{{$count['pending']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Registered Students <span class="float-right"><a href="#" class="btn-link"><i class="fas fa-list"></i> View All</a> </span></div>
                <div class="card-body table-success">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter text-success"><span data-plugin="counterup">{{$count['registered']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter text-success"><span data-plugin="counterup">{{$count['registered_today']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12">
            <div class="card">
                <div class="card-header">List of Registered Students by Programme</div>
                <div class="card-body">
                    <form class="needs-validation" method="POST" action="{{ route('admin.students.index') }}" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="programme_id">Programme Title</label>
                                    <select class="form-control select2" name="programme_id" required>
                                        @foreach($programmes as $programme)
                                            <option value="{{$programme->id}}" >{{$programme->name.' - '.$programme->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">Academic Year</label>
                                    <select class="form-control select2" name="academic_year_id" required>
                                        @foreach($academics as $academic)
                                            <option value="{{$academic->id}}">{{$academic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group pt-1">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary btn-block mt-4">
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
