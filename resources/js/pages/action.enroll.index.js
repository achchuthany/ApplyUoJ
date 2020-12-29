$(document).on('click', '.sa-accept', function (event) {
    var enroll_id = event.target.dataset.enrollid;
    var enroll_status = event.target.dataset.enrollstatus;
    console.log(enroll_status);
    swal.queue([{
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#5b73e8",
        cancelButtonColor: "#8c8c8c",
        confirmButtonText: (enroll_status=="ap")?"Accept":'Enable Resubmission',
        preConfirm: function preConfirm() {
            return new Promise(function (resolve, reject) {
                $.get('/admin/students/enroll/profile/action/' + enroll_id+"/"+enroll_status).done(function (data) {
                    if (data.code == 200) {
                        $("#enroll_status").text(data.status);
                        Swal.fire("Success", data.msg, "success");
                        resolve();
                    } else {
                        Swal.fire("Error!", data.msg, "error");
                        resolve();
                    }
                });

            });
        }
    }])["catch"](swal.noop);
});
