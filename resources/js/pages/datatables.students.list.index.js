$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: url,
            columns: [
                {data: 'ref_no', name: 'ref_no'},
                {data: 'al_index_no', name: 'al_index_no'},
                {data: 'reg_no', name: 'reg_no'},
                {data: 'index_no', name: 'index_no'},
                {data: 'title', name: 'title'},
                {data: 'name_initials', name: 'name_initials'},
                {data: 'nic', name: 'nic'},
                {data: 'mobile', name: 'mobile'},
                {data: 'email', name: 'email'},
                {data: 'full_name', name: 'full_name'},
                {data: 'address', name: 'address'},
                {data: 'registration_date', name: 'registration_date'},
                {data: 'status', name: 'status'},

                {data: 'province', name: 'province'},
                {data: 'district', name: 'district'},
                {data: 'al_z_score', name: 'al_z_score'},
                {data: 'race', name: 'race'},
                {data: 'gender', name: 'gender'},
                {data: 'civil_status', name: 'civil_status'},
                {data: 'religion', name: 'religion'},
                {data: 'date_of_birth', name: 'date_of_birth'},
                {data: 'citizenship', name: 'citizenship'},
                {data: 'citizenship_type', name: 'citizenship_type'},

                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 2, "asc" ]],
            lengthChange: true,
            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50, 100, "All"]],     // page length options
            pageLength: 25,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'colvis','pageLength'
            ]
        }
    );
} );
