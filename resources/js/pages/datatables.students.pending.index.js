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
                {data: 'name', name: 'name'},
                {data: 'nic', name: 'nic'},
                {data: 'mobile', name: 'mobile'},
                {data: 'programme', name: 'programme'},
                {data: 'academic_year', name: 'academic_year'},
                {data: 'updated', name: 'updated'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            lengthChange: true,
            "order": [[ 2, "asc" ]],
            pageLength: 25,
            // dom: 'Bfrtip',
            // buttons: {
            //     buttons: [
            //         {
            //             extend: "excel",
            //             className: "btn-sm btn-info mr-2",
            //             titleAttr: 'Export in Excel',
            //             text: '<i class="fas fa-file-excel"></i> Excel',
            //             init: function(api, node, config) {
            //                 $(node).removeClass('btn-default')
            //             }
            //         },
            //         {
            //             extend: "pdf",
            //             className: "btn-sm btn-info",
            //             titleAttr: 'Export in PDF',
            //             text: '<i class="fas fa-file-pdf"></i> PDF',
            //             init: function(api, node, config) {
            //                 $(node).removeClass('btn-default')
            //             }
            //         }
            //     ]
            // }
        }
    );
} );
