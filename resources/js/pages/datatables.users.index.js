$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "users",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_number', name: 'phone_number'},
                {data: 'update', name: 'update'},
                {data: 'status', name: 'status',orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 3, "desc" ]],
            lengthChange: true,
            pageLength: 25,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'colvis'
            ]
        }
    );
} );
