$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: url,
            columns: [
                {data: 'ref_no', name: 'ref_no'},
                {data: 'image', name: 'image'},
                {data: 'reg_no', name: 'reg_no'},
                {data: 'index_no', name: 'index_no'},
                {data: 'title', name: 'title'},
                {data: 'name_initials', name: 'name_initials'},
                {data: 'nic', name: 'nic'},
                {data: 'mobile', name: 'mobile'},
                {data: 'email', name: 'email'},
                {data: 'full_name', name: 'full_name'},
                {data: 'address', name: 'address'},
                {data: 'registration_date', name: 'registration_date'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 2, "asc" ]],
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
                        text: '<i class="fas fa-file-excel"></i>Export in Excel',
                        init: function(api, node, config) {
                            $(node).removeClass('btn-default')
                        }
                    },'colvis'
                ]
            }
        }
    );
} );
