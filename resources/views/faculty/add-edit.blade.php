@extends('layouts.master-dark-sidebar')
@section('title')
Add a Faculty / Edit Faculty
@endsection
@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Administration @endslot
    @slot('title') Add a Faculty / Edit Faculty @endslot
@endcomponent

    <div class="row">
        <div class="col-lg-12">
                <div class="card">
                        <div class="p-4">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="row">

                                        <div class="col-md-11">
                                            <h5 class="font-size-16 mb-1">Faculty Info </h5>
                                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>
                        <div class="p-4 border-top">
                            <form class="needs-validation" method="POST" action="{{ route('admin.faculties.process') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name">Faculty Name</label>
                                            <input value="{{(isset($faculty)&&!Request::old('name'))? $faculty->name : Request::old('name')}}" id="name" name="name" type="text" class="form-control" required>
                                            <input id="id" class="form-control" type="hidden" name="id" value="{{ (isset($faculty))? $faculty->id   : ''}}" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="shortname">Faculty Abbreviation</label>
                                            <input value="{{(isset($faculty)&&!Request::old('abbreviation'))? $faculty->abbreviation : Request::old('abbreviation')}}" id="abbreviation" name="abbreviation" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mt-4">
                                    <div class="col">
                                        <a href="{{route('admin.faculties.index')}}" class="btn btn-light"><i class="fa fa-arrow-circle-left text-secondary"></i> Back</a>
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

@endsection
