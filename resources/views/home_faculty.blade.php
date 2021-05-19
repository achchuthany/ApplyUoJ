@extends('layouts.master-dark-sidebar')
@section('title')
    Students Statistics
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Home @endslot
        @slot('title') {{$faculty}} @endslot
    @endcomponent
    <div class="card">
        <div class="card-body">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-4">
                <div class="p">
                    Students Statistics
                </div>
            </div>
            <div class="col-xl-8">
                <form class="needs-validation" method="POST" action="{{ route('home.faculty.search') }}">
                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-3">
                            <div class="text-right">Academic Year</div>
                        </div>
                        <div class="col-md-7">
                            <select  name="academic_years[]" class="form-control select2" multiple="multiple" required>
                                @foreach($ays as $ay)
                                    <option value="{{$ay->id}}" {{in_array($ay->id,$selected_ays)?'selected':''}}>{{$ay->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block"><i class="mdi mdi-cloud-search"></i> Apply</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- end col -->
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Total Students <span class="float-right text-light"><a href="{{route('admin.students.all')}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body text-center">
                                <div class="h1 text-info  font-weight-lighter"><span data-plugin="counterup">{{$total}}</span> </div>
                                <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
        @foreach($params as $index=>$value)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{$value}} Students <span class="float-right text-light"><a href="{{route('admin.students.pending',['status'=>$index])}}" class="btn-link"><i class="fas fa-list"></i> View</a> </span></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body  text-center">
                                    <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_today[$index]}}</span> </div>
                                    <div class="font-size-12"><i class="fa fa-user-graduate"></i> Today</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body text-center">
                                    <div class="h1 font-weight-lighter"><span data-plugin="counterup">{{$count_total[$index]}}</span> </div>
                                    <div class="font-size-12"><i class="fa fa-user-graduate"></i> Total</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        @endforeach
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
    </script>
@endsection
