$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "/admin/students/all",
            columns: [
                {data: 'ref_no', name: 'ref_no',orderable: false, searchable: false},
                {data: 'al_index_number', name: 'students.al_index_number'},
                {data: 'full_name', name: 'students.full_name'},
                {data: 'nic', name: 'students.nic'},
                {data: 'mobile', name: 'students.mobile'},
                {data: 'programme_name', name: 'programmes.name'},
                {data: 'academic_year_name', name: 'academic_years.name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 6, "desc" ]],
            lengthChange: true,
            "lengthMenu": [[10, 25, 50,100], [10, 25, 50, 100]],     // page length options
            pageLength: 25,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'colvis','pageLength'
            ]
        }
    );
} );
