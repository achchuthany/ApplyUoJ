@extends('layouts.master-dark-sidebar')
@section('title')
    Preview of Student's Index Number
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Students @endslot
        @slot('title') Preview of Student's Index Number @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-4">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-centered datatable dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Reg. No.</th>
                                <th>Full Name</th>
                                <th>NIC</th>
                                <th>Preview Index</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($enrolls as $enroll)
                                <tr>
                                    <td>{{$enroll->reg_no}}</td>
                                    <td>{{$enroll->full_name}}</td>
                                    <td>{{$enroll->nic}}</td>
                                    <td>{{$faculty->abbreviation}}{{$faculty->next_index_number++}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                @if($enrolls->count()>0)
                <div class="card-footer bg-soft-info">
                    <div class="row">
                        <div class="col-md-8 offset-md-2 text-center">
                            <form class="form-inline " method="POST" action="{{ route('admin.enroll.assign.index.process',['pid'=>$application->programme_id,'aid'=>$application->academic_year_id]) }}">
                                @csrf
                                <div class="alert fade show" role="alert">
                                    <i class="mdi mdi-progress-check d-block display-4 mt-2 mb-3 text-info"></i>
                                    <h4 class="text-info"> Do you want to assign the index number?</h4>
                                    <p>You are about to assign the index number of the above students. This <b>cannot</b> be undone.</p>
                                    <button type="submit" class="btn btn-primary mb-2 mr-2"><i class="mdi mdi-progress-check"></i> Assign Index Number</button>

                                    <a  href="{{route('admin.application.registrations.index')}}" class="btn btn-light mb-2 mr-3"><i class="mdi mdi-cancel"></i> Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->



@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        var message = "{{Session::get('message')}}";
        var message_type = "{{Session::get('message_type')}}";
    </script>
    <script src="{{ URL::asset('assets/js/pages/sweetalert.index.js')}}"></script>
@endsection
