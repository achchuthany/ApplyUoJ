@extends('layouts.master-dark-sidebar')
@section('title')
    {{$programme->name}} - {{$academic->name}} - {{$filter}}

@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Students @endslot
    @slot('title') {{$programme->name}} - {{$academic->name}} @endslot
@endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-9">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="mt-2">
                                      <p class="mb-1 text-primary">Faculty </p>
                                      <h5 class="font-size-16">{{$programme->faculty->name}} ({{$programme->faculty->abbreviation}}) </h5>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mt-2">
                                      <p class="mb-1 text-primary">Programme</p>
                                      <h5 class="font-size-16">{{$programme->name}} ({{$programme->abbreviation}}) </h5>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mt-2">
                                      <p class="mb-1 text-primary">Academic Year</p>
                                      <h5 class="font-size-16">{{$academic->name}} </h5>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="mt-2">
                                      <p class="mb-1 text-primary">Filter By</p>
                                      <h5 class="font-size-16">{{$filter}} </h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <div class="col-md-3 text-center ">
                        <div class="mt-2 text-center">
{{--                            <p class="mb-1 text-primary">Number of Students <a class="btn btn-sm btn-primary" target="_blank" href="{{route('student.registration.download.PersonalData.all',['pid'=>request()->route('pid'),'aid'=>request()->route('aid'),'status'=>request()->route('status')])}}"><i class="mdi mdi-file-pdf"></i> Export</a></p>--}}

                            <h5 class="display-3 text-primary" data-plugin="counterup">{{$count}} </h5>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="card-body bg-light">
                    <div class="row">
                        @foreach($count_total as $key => $value)
                            @if($key !='de')
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="font-weight-lighter font-size-14">{{$params[$key]}}</div>
                                        </div>
                                        <div class="col-4">
                                            <span class="text-primary text-right" data-plugin="counterup">{{$value}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="card-body table-responsive mb-4">
                    <table id="datatable"  class="table table-hover  table-striped table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr class="bg-transparent">
                            <th>Reference</th>
                            <th>AL Index No.</th>
                            <th>Reg. No.</th>
                            <th>Index. No.</th>
                            <th>Title</th>
                            <th>Name With Initials</th>
                            <th>NIC No.</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th>Permanent Address</th>
                            <th>Date of Registration</th>
                            <th>Registration Status</th>

                            <th>Province</th>
                            <th>District</th>
                            <th>AL Z Score </th>
                            <th>Race </th>
                            <th>Gender </th>
                            <th>Civil Status </th>
                            <th>Religion </th>
                            <th>Date of Birth </th>
                            <th>Citizenship </th>
                            <th>Citizenship Type </th>

                            <th>Profile</th>
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
    <script src="{{ URL::asset('assets/js/pages/datatables.students.list.index.js')}}"></script>
        <script>
        var url = '/admin/students/search/{{Route::current()->parameters['pid']}}/{{Route::current()->parameters['aid']}}/{{Route::current()->parameters['status']}}';
    </script>
@endsection
