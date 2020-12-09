$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "/admin/application/registrations",
            columns: [
                {data: 'academic_year', name: 'academic_year'},
                {data: 'programme', name: 'abbreviation'},
                {data: 'count_received', name: 'count_received'},
                {data: 'count_called', name: 'count_called'},
                {data: 'open_date', name: 'open_date'},
                {data: 'close_date', name: 'close_date'},
                {data: 'next_registration_number', name: 'next_registration_number'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            lengthChange: true,
            pageLength: 20,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print','colvis'
            ]
        }
    );
} );
