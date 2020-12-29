$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: url,
            columns: [
                {data: 'image', name: 'image'},
                {data: 'reg_no', name: 'reg_no'},
                {data: 'index_no', name: 'index_no'},
                {data: 'title', name: 'title'},
                {data: 'name_initials', name: 'name_initials'},
                {data: 'nic', name: 'nic'},
                {data: 'mobile', name: 'mobile'},
                {data: 'full_name', name: 'full_name'},
                {data: 'registration_date', name: 'registration_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 1, "asc" ]],
            lengthChange: true,
            pageLength: 100,
            dom: 'Bfrtip',
            // dom: 'Bfrtip',
            buttons: {
                buttons: [
                    {
                        extend: "excel",
                        className: "btn-sm btn-primary mr-2",
                        titleAttr: 'Export in Excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        init: function(api, node, config) {
                            $(node).removeClass('btn-default')
                        }
                    },'colvis'
                ]
            }
        }
    );
} );
