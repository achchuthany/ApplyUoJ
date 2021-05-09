$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "faculties",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'abbreviation', name: 'abbreviation'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 0, "asc" ]],
            lengthChange: true,
            pageLength: 25,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print','colvis'
            ]
        }
    );
} );
