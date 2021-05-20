$(document).on('click', '.sa-accept', function (event) {
    var enroll_id = event.target.dataset.enrollid;
    var enroll_status = event.target.dataset.enrollstatus;
    // console.log(enroll_status);
    swal.queue([{
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#5b73e8",
        cancelButtonColor: "#8c8c8c",
        confirmButtonText: (enroll_status=="ap")?"Accept":'Enable Resubmission',
        allowOutsideClick: false,
        allowEscapeKey: false,
        preConfirm: function preConfirm() {
            var message = null;
            if(enroll_status=="ap"){
                message = "Your application has been accepted and you do not need to take any action."
            }else{
                message = "Please check your online application. There is a problem with your online application, you need to modify your application again. These are the problem with your application:  Identity Card Image not fully uploaded "
            }
            (async () => {
                const { value: text } = await Swal.fire({
                    input: 'textarea',
                    inputLabel: 'Notify Student',
                    inputValue: message,
                    inputPlaceholder: 'Type your message here...',
                    inputAttributes: {
                        'aria-label': 'Type your message here'
                    },
                    showCancelButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: '<i class="fa fa-envelope"></i>&nbsp; Notify',
                })

                if (text) {
                    return new Promise(function (resolve, reject) {
                        $.post('/admin/students/enroll/profile/action/' + enroll_id+"/"+enroll_status,{
                            'enroll_id':enroll_id,
                            'enroll_status':enroll_status,
                            'message':text,
                            '_token':_token
                        }).done(function (data) {
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

            })()

        }
    }])["catch"](swal.noop);
});
