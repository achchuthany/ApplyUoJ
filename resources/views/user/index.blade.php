@extends('layouts.master-dark-sidebar')
@section('title')
User Details
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Administration @endslot
    @slot('title') User Details @endslot
@endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('users.add')}}" class="btn btn-success waves-effect waves-light mb-3 float-right"><i class="mdi mdi-plus mr-1"></i> Add New User</a>
                    <div class="table-responsive mb-4">
                        <table id="datatable"  class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="bg-transparent">
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Phone</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
    <script src="{{ URL::asset('assets/js/pages/datatables.users.index.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/delete.users.index.js')}}"></script>
@endsection
