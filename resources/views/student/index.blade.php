@extends('layouts.master-dark-sidebar')
@section('title')
    Students Statistics
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Student @endslot
        @slot('title') Students Statistics @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Total Students <span class="float-right text-light"><a href="{{route('admin.students.all')}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count['ugc']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total Students</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-md-4">
            <div class="card bg-soft-warning">
                <div class="card-header">Documents Pending Students <span class="float-right text-light"><a href="{{route('admin.students.pending',['status'=>'dp'])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_today['dp']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_total['dp']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-md-4">
            <div class="card bg-soft-info">
                <div class="card-header">Registration Processing Students <span class="float-right text-light"><a href="{{route('admin.students.pending',['status'=>'ps'])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_today['ps']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_total['ps']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-md-4">
            <div class="card bg-soft-primary">
                <div class="card-header">Registration Accepted Students <span class="float-right text-light"><a href="{{route('admin.students.pending',['status'=>'ap'])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_today['ap']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_total['ap']}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-md-4">
            <div class="card bg-soft-success">
                <div class="card-header">Registered Students <span class="float-right"><a href="{{route('admin.students.pending',['status'=>'rg'])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_today['rg']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_total['rg']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-md-4">
            <div class="card bg-soft-purple">
                <div class="card-header">Rejected Students <span class="float-right"><a href="{{route('admin.students.pending',['status'=>'re'])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_today['re']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_total['re']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-md-4">
            <div class="card bg-soft-secondary">
                <div class="card-header">Transferred Students <span class="float-right"><a href="{{route('admin.students.pending',['status'=>'tr'])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_today['tr']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_total['tr']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-md-4">
            <div class="card bg-soft-pink">
                <div class="card-header">Dropout Students <span class="float-right"><a href="{{route('admin.students.pending',['status'=>'dr'])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_today['dr']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_total['dr']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-md-4">
            <div class="card bg-soft-danger">
                <div class="card-header">Deleted Students <span class="float-right"><a href="{{route('admin.students.pending',['status'=>'de'])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body  text-center">
                                <div class="h1 font-weight-lighter text-secondary"><span data-plugin="counterup">{{$count_today['de']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body text-center">
                                <div class="h1 font-weight-lighter text-secondary"><span data-plugin="counterup">{{$count_total['de']}}</span></div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
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
