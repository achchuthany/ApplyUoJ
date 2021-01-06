$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "users",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'nic', name: 'nic'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
                {data: 'roles', name: 'roles'},
                {data: 'update', name: 'update'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            lengthChange: true,
            pageLength: 10,
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'excel', 'pdf', 'colvis'
            // ]
        }
    );
} );
