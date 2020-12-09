
$(document).ready(function () {
    $('#datatable').DataTable({
        processing: true,
        retrieve: true,
        lengthChange: true,
        pageLength: 100,
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf', 'colvis']
    });
});
