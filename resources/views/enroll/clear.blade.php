@extends('layouts.master-dark-sidebar')
@section('title')
    Student Registration
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Student Registration @endslot
        @slot('title') Clear Registration Number Assignment @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-4">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-centered datatable dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>NIC</th>
                                <th>Date of Registration</th>
                                <th>Assigned Reg. No.</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($enrolls as $enroll)
                                <tr>
                                    <td>{{$enroll->full_name}}</td>
                                    <td>{{$enroll->nic}}</td>
                                    <td>{{($enroll->registration_date)?Carbon\Carbon::parse($enroll->registration_date)->toFormattedDateString():''}}</td>
                                    <td><i class="mdi mdi-lock-outline text-success" data-toggle="tooltip" data-placement="top" title="Assigned Registration Number"></i> {{$enroll->reg_no}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="card-footer">
                   <div class="row">
                       @if($isNotVisible)
                       <div class="col-md-8 offset-md-2 text-center">
                           <div class="alert fade show d-block" role="alert">

                               <h4 class="text-danger"><i class="mdi mdi-information-outline text-danger"></i> Data was edited on three days before.</h4>
                               </p>
                           </div>
                       </div>
                       @else
                       <div class="col-md-8 offset-md-2 text-center">
                           <form class="form-inline" method="POST" action="{{ route('admin.enroll.assign.reg.delete',['pid'=>$application->programme_id,'aid'=>$application->academic_year_id]) }}">
                               @csrf
                               <div class="alert fade show d-block" role="alert">
                                   <i class="uil uil-exclamation-octagon d-block display-4 mt-2 mb-3 text-danger"></i>
                                   <h4 class="text-danger"> Do you want to reset the registration number?</h4>
                                   <p>You are about to reset the registration numbers of the above students.
                                       This <b>cannot</b> be undone.</p>
                                   <a  href="{{route('admin.application.registrations.index')}}" class="btn btn-light mb-2 mr-3"><i class="mdi mdi-cancel"></i> Cancel</a>
                                   <button type="submit" class="btn btn-danger mb-2"><i class="mdi mdi-delete-outline"></i> Clear</button>

                               </div>
                           </form>
                       </div>
                           @endif
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
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        var message = "{{Session::get('message')}}";
        var message_type = "{{Session::get('message_type')}}";
    </script>
    <script src="{{ URL::asset('assets/js/pages/sweetalert.index.js')}}"></script>
@endsection
