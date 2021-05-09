$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "/admin/programmes",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'faculty', name: 'faculty'},
                {data: 'type', name: 'type'},
                {data: 'abbreviation', name: 'abbreviation'},
                {data: 'duration', name: 'duration'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            lengthChange: false,
            pageLength: 25,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'colvis'
            ]
        }
    );
} );
