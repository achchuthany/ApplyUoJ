$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "/admin/students/all",
            columns: [
                {data: 'ref_no', name: 'ref_no'},
                {data: 'al_index_no', name: 'al_index_no'},
                {data: 'name', name: 'name'},
                {data: 'nic', name: 'nic'},
                {data: 'mobile', name: 'mobile'},
                {data: 'programme', name: 'programme'},
                {data: 'academic_year', name: 'academic_year'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 2, "asc" ]],
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
