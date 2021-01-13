$(document).ready(function() {
    $('#datatable').DataTable(
        {
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: '/admin/students/delete',
            columns: [
                {data: 'name', name: 'name'},
                {data: 'nic', name: 'nic'},
                {data: 'mobile', name: 'mobile'},
                {data: 'enrolls', name: 'enrolls'},
                {data: 'updated', name: 'updated'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "order": [[ 4, "desc" ]],
            lengthChange: true,
            pageLength: 100,
        }
    );
} );

//Delete
$(document).on('click', '.sa-delete', function(event) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#f46a6a",
        cancelButtonColor: "#8c8c8c",
        confirmButtonText: "Yes, delete it!",
        preConfirm: function () {
            document.querySelector('#delete').submit(); // manully submit
        }
    });
});
