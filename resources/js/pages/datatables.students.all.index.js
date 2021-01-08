$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "/admin/students/all",
            columns: [
                {data: 'ref_no', name: 'ref_no'},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'nic', name: 'nic'},
                {data: 'mobile', name: 'mobile'},
                {data: 'programme', name: 'programme'},
                {data: 'academic_year', name: 'academic_year'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            lengthChange: true,
            "order": [[ 2, "asc" ]],
            pageLength: 50,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print','colvis'
            ]
        }
    );
} );
