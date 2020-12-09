@extends('layouts.master-dark-sidebar')
@section('title')
    Students
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Student @endslot
        @slot('title') List of Students @endslot
    @endcomponent
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header">UGC Student's List <span class="float-right text-light"><a href="#" class="btn-link"><i class="fas fa-list"></i> View All</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter">250  </div>
                                <div class="h6"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-4">
            <div class="card">
                <div class="card-header bg-warning text-light">Registration Pending Students <span class="float-right text-light"><a href="#" class="btn-link text-light"><i class="fas fa-list"></i> View All</a> </span></div>
                <div class="card-body table-warning">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter">250</div>
                                <div class="h6"> <i class="fa fa-user-graduate"></i> Today</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter">250</div>
                                <div class="h6"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-5">
            <div class="card">
                <div class="card-header bg-success text-light">Registered Students <span class="float-right"><a href="#" class="btn-link text-light"><i class="fas fa-list"></i> View All</a> </span></div>
                <div class="card-body table-success">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter">250</div>
                                <div class="h6"> <i class="fa fa-user-graduate"></i> Today</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter">255550</div>
                                <div class="h6"><i class="fa fa-user-graduate"></i> Total</div>
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
@endsection
