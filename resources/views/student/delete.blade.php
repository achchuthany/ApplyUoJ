@extends('layouts.master-dark-sidebar')
@section('title')
    Student's Bulk Delete
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Students @endslot
    @slot('title')Bulk Delete @endslot
@endcomponent
    <div class="row">
        <div class="col-12">
            <form class="needs-validation" id="delete" method="POST" action="{{ route('admin.students.delete.process') }}">
                @csrf
                <div class="card">
                <div class="card-header bg-danger text-light">
                    Danger Zone
                </div>
                <div class="card-body table-responsive mb-4">
                    <table id="datatable"  class="table table-borderless table-hover table-centered datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>NIC No.</th>
                            <th>Mobile</th>
                            <th>Enrolls</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-outline-danger float-right sa-delete" ><i class="mdi mdi-delete-outline"></i>Bulk Delete </button>
                </div>
            </div>
            </form>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/jquery-form/jquery-form.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>

    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/datatables.students.delete.index.js')}}"></script>
    <script>
        var message = "{{Session::get('message')}}";
        var message_type = "{{Session::get('message_type')}}";
    </script>
    <script src="{{ URL::asset('assets/js/pages/sweetalert.index.js')}}"></script>
@endsection
