@extends('layouts.master-dark-sidebar')
@section('title')
Add New Academic Year
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Academic Year @endslot
    @slot('title') Add New Academic Year @endslot
@endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div id="addproduct-accordion" class="custom-accordion">
                <div class="card">
                    <a  class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                        <div class="p-4">
                            <div class="media align-items-center">
                                <div class="media-body overflow-hidden">
                                    <h5 class="font-size-16 mb-1">Academic Year Info</h5>
                                    <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div>
                        <div class="p-4 border-top">
                            <form class="needs-validation" method="POST" action="{{ route('admin.academic.years.process') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="application_year">Application Year</label>
                                            <input value="{{(isset($ay)&&!Request::old('application_year'))? $ay->application_year : Request::old('application_year')}}" id="application_year" name="application_year" type="text" class="form-control" pattern="[0-9]{4}" placeholder="2020" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="academic_year">Academic Year</label>
                                            <input value="{{(isset($ay)&&!Request::old('academic_year'))? $ay->name : Request::old('academic_year')}}" id="academic_year" name="academic_year" type="text" class="form-control" pattern="[0-9]{4}(\/)[0-9]{4}" placeholder="2020/2021" required>
                                            <input id="id" class="form-control" type="hidden" name="id" value="{{ (isset($ay))? $ay->id   : ''}}" >
                                            @if ($errors->has('name'))
                                                <div class="text-danger">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start">Start Date</label>
                                            <input value="{{(isset($ay)&&!Request::old('start'))? $ay->date_of_start : Request::old('start')}}" id="start" name="start" type="date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end">Start End</label>
                                            <input value="{{(isset($ay)&&!Request::old('end'))? $ay->date_of_end : Request::old('end')}}" id="end" name="end" type="date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="next_payer_id">Next Payer ID</label>
                                            <input value="{{(isset($ay)&&!Request::old('next_payer_id'))? $ay->next_payer_id : Request::old('next_payer_id')}}" id="next_payer_id" name="next_payer_id" type="text" class="form-control bg-soft-warning" required readonly>
                                            <span class="text-danger">Please do not edit this field.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="form-control select2" name="status" required>
                                                <option value="Published" {{(isset($ay)&&!Request::old('status'))? (($ay->status  == 'Published')? 'selected':'') : ( (Request::old('status') =='Published')? 'selected':'')}}>Published</option>
                                                <option value="Draft" {{(isset($ay)&&!Request::old('status'))? (($ay->status  == 'Draft')? 'selected':'') : ( (Request::old('status') =='Draft')? 'selected':'')}}>Draft</option>
                                                <option value="Closed" {{(isset($ay)&&!Request::old('status'))? (($ay->status  == 'Closed')? 'selected':'') : ( (Request::old('status') =='Closed')? 'selected':'')}}>Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <!-- end row -->
                                <div class="row mt-4">
                                    <div class="col">
                                        <a href="{{route('admin.academic.years.index')}}" class="btn btn-light"><i class="fa fa-arrow-circle-left text-secondary"></i> Back</a>
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
