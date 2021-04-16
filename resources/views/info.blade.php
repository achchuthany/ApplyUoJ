@extends('layouts.master-without-nav-index')
@section('title')
    Online Registration
@endsection

@section('content')
<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="row justify-content-center align-items-center mt-4">
            <div class="col-md-12">
                <div class="h2 font-weight-lighter text-light text-center">
                    Online Registration of Students for Courses of Study
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center mt-4">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <a href="{{url('/')}}" class="d-block auth-logo">
                                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA"  height="70" class="logo logo-dark">
                                    <img src="{{ URL::asset('assets/images/uoj.png')}}" alt="UNIVERSITY OF JAFFNA"  height="70"  class="logo logo-light">
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-xl-12">
                            <div class="card bg-transparent shadow-none">
                                <div class="card-header">
                                    <a class="btn btn-primary btn-sm float-right" href="{{route('welcome')}}"><i class="mdi mdi-arrow-left"></i> Back</a> Call for Registration
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <th>Faculty</th>
                                                <th>Programme</th>
                                                <th>Closing Date</th>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $row)
                                                    <tr>
                                                        <td>{{$row->programme->faculty->name}}</td>
                                                        <td>{{$row->programme->name}}</td>
                                                        <td>{{\Carbon\Carbon::parse($row->close_date)->toFormattedDateString()}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <!-- end row -->
@endsection
