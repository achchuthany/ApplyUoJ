@extends('layouts.master-dark-sidebar')
@section('title')
    UGC Student's List Bulk Upload
@endsection
@section('css')
<link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
    @slot('pagetitle') Students @endslot
    @slot('title')UGC Student's List Bulk Upload @endslot
@endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-right">
                        <span class="text-muted">
                            <a href="{{URL::asset('assets/images/csv/ugc-list-sample.csv') }}" class="float-right btn-sm btn-light">
                                <i class=" uil-download-alt"></i> CSV Template </a>
                        </span>
                    </div>

                    <h4 class="card-title mb-4">Bulk update students</h4>
                    <p ><i class="fas fa-info-circle text-info"></i> Add or edit Student info in CSV template.
                        Required fields are Full name, Shortname, NIC Number, Registration No, Index No, E-mail, Mobile and Address.
                    </p>

                    <form class="needs-validation" method="POST" action="{{ route('admin.students.upload.check') }}" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="programme_id">Programme Title</label>
                                    <select class="form-control select2" name="programme_id" required>
                                        @foreach($programmes as $programme)
                                            <option value="{{$programme->id}}" {{old('programme_id')==$programme->id?'selected':''}} >{{$programme->name.' - '.$programme->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">Academic Year</label>
                                    <select class="form-control select2" name="academic_year_id" required>
                                        @foreach($academics as $academic)
                                            <option value="{{$academic->id}}" {{old('academic_year_id')==$programme->id?'selected':''}}>{{$academic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="validationCustom03">Upload CSV</label>
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="csv_file" name="csv_file" required>
                                    </div>
                                    @if ($errors->has('csv_file'))
                                        <div class="text-danger">
                                            <strong>{{ $errors->first('csv_file') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <span class=""><i class="fas fa-info-circle text-warning"></i> Keep the CSV File header row</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <a href="{{route('admin.students.index')}}" class="btn btn-light"><i class="fa fa-arrow-circle-left text-secondary"></i> Back</a>
                            </div>
                            <div class="col text-right">
                                <button  type="submit" class="btn btn-primary"> Next <i class="mdi mdi-arrow-right-circle mr-1"></i> </button>
                            </div> <!-- end col -->
                        </div> <!-- end row-->

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
    </script>
    {{--    sweetalert--}}
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        var message = "{{Session::get('message')}}";
        var message_type = "{{Session::get('message_type')}}";
    </script>
    <script src="{{ URL::asset('assets/js/pages/sweetalert.index.js')}}"></script>
@endsection
