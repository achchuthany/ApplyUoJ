@extends('layouts.master-dark-sidebar')
@section('title')
    Student Registration
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Administration @endslot
        @slot('title') Student Registration @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-4">
                    <div class="card-body min-vh-100">
                        <table id="datatable" class="table table-striped table-centered datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Academic Year</th>
                                <th>Programme</th>
                                <th>#Registered</th>
                                <th>#Count</th>
                                <th>Calling Date</th>
                                <th>Closing Date</th>
                                <th>Next Registration Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
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
    <script src="{{ URL::asset('assets/js/pages/datatables.application.registrations.index.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/delete.application.registrations.index.js')}}"></script>
    <script>
        var message = "{{Session::get('message')}}";
        var message_type = "{{Session::get('message_type')}}";
    </script>
    <script src="{{ URL::asset('assets/js/pages/sweetalert.index.js')}}"></script>
@endsection
