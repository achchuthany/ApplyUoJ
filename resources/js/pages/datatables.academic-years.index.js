$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "/admin/academic-years",
            columns: [
                {data: 'application_year', name: 'application_year'},
                {data: 'name', name: 'name'},
                {data: 'date_of_start', name: 'date_of_start'},
                {data: 'date_of_end', name: 'date_of_end'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 0, "desc" ]],
            lengthChange: false,
            pageLength: 25,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'colvis'
            ]
        }
    );
} );
