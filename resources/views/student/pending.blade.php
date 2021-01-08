@extends('layouts.master-dark-sidebar')
@section('title')
{{$title}} Online Registrations
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Students @endslot
    @slot('title')<a href="{{route('admin.students.index')}}"> <i class="uil uil-arrow-left "></i> </a> {{$title}} Online Registrations @endslot
@endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive mb-4">

                    <table id="datatable"  class="table  table-hover  table-striped table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr class="bg-transparent">
                            <th>Reference</th>
                            <th>Image</th>
                            <th>Name With Initials</th>
                            <th>NIC No.</th>
                            <th>Mobile</th>
                            <th>Programme</th>
                            <th>Academic Year</th>
                            <th>Updated</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/datatables.students.pending.index.js')}}"></script>
<script>
    var url = '/admin/students/cat/{{Route::current()->parameters['status']}}';
</script>
@endsection
