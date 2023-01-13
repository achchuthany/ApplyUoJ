$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: url,
            columns: [
                {data: 'ref_no', name: 'ref_no', orderable: false, searchable: false},
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'full_name', name: 'students.full_name'},
                {data: 'nic', name: 'students.nic'},
                {data: 'mobile', name: 'students.mobile'},
                {data: 'programme_name', name: 'programmes.name'},
                {data: 'academic_year_name', name: 'academic_years.name'},
                {data: 'updated', name: 'updated',orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
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
