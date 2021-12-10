@extends('layouts.master-dark-sidebar')
@section('title')
    Students Search
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Student @endslot
        @slot('title') Search Students  @endslot
    @endcomponent

    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <div class="card bg-transparent shadow-none">
                <div class="bg-transparent shadow-none">
                    <form class="needs-validation" method="POST" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control select2" name="programme_id" id="programme_id" required>
                                        @foreach($programmes as $programme)
                                            <option value="{{$programme->id}}" >{{$programme->name.' - '.$programme->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select2" name="academic_year_id" id="academic_year_id" required>
                                        @foreach($academics as $academic)
                                            <option value="{{$academic->id}}">{{$academic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <button type="button" id="search-identity-card" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-4">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-centered datatable dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Registration No.</th>
                                <th>NIC No.</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Modal -->
    <div class="modal fade" id="identity_card_model" tabindex="-1" aria-labelledby="student_name" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div id="student_image" class="text-center"></div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-primary">Full Name</h6>
                            <p id="student_full_name">...</p>
                            <h6 class="text-primary">Programme</h6>
                            <p id="student_programme">...</p>
                            <h6 class="text-primary">Registration Number</h6>
                            <p id="student_reg_no">...</p>
                            <h6 class="text-primary">NIC Number</h6>
                            <p id="student_nic">...</p>
                            <h6 class="text-primary">Address</h6>
                            <p id="student_address">...</p>
                        </div>
                    </div>

                </div>
                <div class="pt-3 float-none bg-primary text-light text-center">
                    <p id="student_faculty">...</p>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();

        $('#search-identity-card').on('click',function(){
            console.log('Search Clicked');
            let aid = $('#academic_year_id').val();
            let pid = $('#programme_id').val();
            var table = $('#datatable').DataTable(
                {
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: "/admin/students/identity/"+pid+"/"+aid,
                    columns: [
                        {data: 'title', name: 'title'},
                        {data: 'name_initials', name: 'name_initials'},
                        {data: 'reg_no', name: 'reg_no'},
                        {data: 'nic', name: 'nic'},

                    ],
                    "order": [[ 0, "asc" ]],
                    lengthChange: true,
                    pageLength: 25,

                }
            ).ajax.reload();

            $('#datatable tbody').on( 'click', 'tr', function () {
                $('#student_full_name').text($('#datatable').DataTable().row( this ).data().title+" "+$('#datatable').DataTable().row( this ).data().full_name);
                $('#student_nic').text($('#datatable').DataTable().row( this ).data().nic);
                $('#student_reg_no').text($('#datatable').DataTable().row( this ).data().reg_no);
                $('#student_address').html($('#datatable').DataTable().row( this ).data().address);
                $('#student_programme').html($('#datatable').DataTable().row( this ).data().programme);
                $('#student_faculty').text($('#datatable').DataTable().row( this ).data().faculty+", UNIVERSITY OF JAFFNA");
                $('#student_image').html($('#datatable').DataTable().row( this ).data().image);
                $('#identity_card_model').modal('show')
            } );
        });
    </script>
@endsection
