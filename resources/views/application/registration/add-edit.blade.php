@extends('layouts.master-dark-sidebar')
@section('title')
    Add a  Registration Application / Edit
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Administration @endslot
    @slot('title') Add a  Registration Application / Edit @endslot
@endcomponent

    <div class="row">
        <div class="col-lg-12">
                <div class="card">
                        <div class="p-4">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="row">

                                        <div class="col-md-11">
                                            <h5 class="font-size-16 mb-1">Registration Application Info </h5>
                                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>
                        <div class="p-4 border-top">
                            <form class="needs-validation" method="POST" action="{{ route('admin.application.registrations.process') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="academic_year_id">Academic Year</label>
                                            <select class="form-control select2" name="academic_year_id" required>
                                                <option hidden disabled selected value> -- Select an Option -- </option>
                                                @foreach($academics as $pm)
                                                    <option value="{{$pm->id}}" {{(isset($ea)&&!Request::old('academic_year_id'))? (($pm->id  == $ea->academic_year_id)? 'selected':'disabled') : ( (Request::old('academic_year_id') ==$pm->id)? 'selected':'')}}>{{$pm->name}} - Application Year {{$pm->application_year}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="programme_id">Programme</label>
                                            <select class="form-control select2" name="programme_id" required>
                                                <option hidden disabled selected value> -- Select an Option -- </option>
                                                @foreach($programmes as $pm)
                                                    <option value="{{$pm->id}}" {{(isset($ea)&&!Request::old('programme_id'))? (($pm->id  == $ea->programme_id)? 'selected':'disabled') : ( (Request::old('programme_id') ==$pm->id)? 'selected':'')}}>{{$pm->name}} ({{$pm->abbreviation}}) ({{$pm->type}}) ({{$pm->faculty->name}})</option>
                                                @endforeach
                                            </select>
                                            <input id="id" class="form-control" type="hidden" name="id" value="{{ (isset($ea))? $ea->id   : ''}}" >

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Calling Date</label>
                                            <input value="{{(isset($ea)&&!Request::old('open_date'))? $ea->open_date : Request::old('open_date')}}"  id="open_date" name="open_date" type="date" class="form-control" required>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Closing Date</label>
                                            <input value="{{(isset($ea)&&!Request::old('close_date'))? $ea->close_date : Request::old('close_date')}}"  id="close_date" name="close_date" type="date" class="form-control" required>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Bank Payment: Account Number</label>
                                            <input value="{{(isset($ea)&&!Request::old('account_number'))? $ea->account_number : Request::old('account_number')}}"  id="account_number" name="account_number" type="text" class="form-control" required>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Bank Payment: Deposit Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-text">LKR</div>
                                                <input value="{{(isset($ea)&&!Request::old('deposit_amount'))? $ea->deposit_amount : Request::old('deposit_amount')}}"  id="deposit_amount" name="deposit_amount" type="text" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="form-control select2" name="status" required>
                                                <option value="Draft" {{(isset($ea)&&!Request::old('status'))? (($ea->status  == 'Draft')? 'selected':'') : ( (Request::old('status') =='Draft')? 'selected':'')}}>Draft</option>
                                                <option value="Published" {{(isset($ea)&&!Request::old('status'))? (($ea->status  == 'Published')? 'selected':'') : ( (Request::old('status') =='Published')? 'selected':'')}}>Published</option>
                                                <option value="Processing" {{(isset($ea)&&!Request::old('status'))? (($ea->status  == 'Processing')? 'selected':'') : ( (Request::old('status') =='Processing')? 'selected':'')}}>Processing</option>
                                                <option value="Closed" {{(isset($ea)&&!Request::old('status'))? (($ea->status  == 'Closed')? 'selected':'') : ( (Request::old('status') =='Closed')? 'selected':'')}}>Closed</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <!-- end row -->
                                <div class="row mt-4">
                                    <div class="col">
                                        <a href="{{route('admin.application.registrations.index')}}" class="btn btn-light"><i class="fa fa-arrow-circle-left text-secondary"></i> Back</a>
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
@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
    </script>
@endsection
