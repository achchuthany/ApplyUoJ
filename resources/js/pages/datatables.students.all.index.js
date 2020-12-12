$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "/admin/students/all",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'nic', name: 'nic'},
                {data: 'mobile', name: 'mobile'},
                {data: 'programme', name: 'programme'},
                {data: 'academic_year', name: 'academic_year'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            lengthChange: true,
            pageLength: 50,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print','colvis'
            ]
        }
    );
} );
