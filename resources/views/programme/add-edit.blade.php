@extends('layouts.master-dark-sidebar')
@section('title')
Add New Programme
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Programmes @endslot
    @slot('title') Add New Programme @endslot
@endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div id="addproduct-accordion" class="custom-accordion">
                <div class="card">
                    <a  class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                        <div class="p-4">
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-16 mb-1">Programme Info</h5>
                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div>
                        <div class="p-4 border-top">
                            <form class="needs-validation" method="POST" action="{{ route('admin.programmes.process') }}" novalidate>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Programme Name</label>
                                            <input value="{{(isset($programme)&&!Request::old('name'))? $programme->name : Request::old('name')}}" id="name" name="name" type="text" class="form-control" required>
                                            <input id="id" class="form-control" type="hidden" name="id" value="{{ (isset($programme))? $programme->id   : ''}}" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="abbreviation">Programme Abbreviation</label>
                                            <input value="{{(isset($programme)&&!Request::old('abbreviation'))? $programme->abbreviation : Request::old('abbreviation')}}" id="abbreviation" name="abbreviation" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">Faculty</label>
                                            <select class="form-control select2" name="faculty_id">
                                                @foreach($faculties as $faculty)
                                                    <option value="{{$faculty->id}}" {{(isset($programme)&&!Request::old('faculty_id'))? (($programme->faculty_id  == $faculty->id)? 'selected':'') : ( (Request::old('faculty_id') ==$faculty->id)? 'selected':'')}}>{{$faculty->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <select class="select2 form-control"  name="type">
                                                @foreach($types as $index=>$value)
                                                    <option value="{{$value}}" {{(isset($programme)&&!Request::old('type'))? (($programme->type  == $value)? 'selected':'') : ( (Request::old('type') ==$value)? 'selected':'')}}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="duration">Duration (Years)</label>
                                            <input value="{{(isset($programme)&&!Request::old('duration'))? $programme->duration : Request::old('duration')}}"  id="duration" name="duration" type="number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mt-4">
                                    <div class="col">
                                        <a href="{{route('admin.programmes.index')}}" class="btn btn-light"><i class="fa fa-arrow-circle-left text-secondary"></i> Back</a>
                                    </div>
                                    <div class="col text-right">
                                        <button  type="submit" class="btn btn-primary"> <i class="mdi mdi-content-save mr-1"></i> Save </button>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js')}}"></script>
    <script>
        $(".select2").select2();
    </script>
@endsection
