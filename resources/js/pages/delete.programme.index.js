function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}


$(document).on('click', '.sa-warning', function(event){
    var exam_id = event.target.parentNode.dataset.exam ;
    var exam_row = event.target.parentElement.parentElement.parentElement.parentElement.parentElement;
    console.log(exam_id);
    swal.queue([{
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#f46a6a",
        cancelButtonColor: "#8c8c8c",
        confirmButtonText: "Yes, delete it!",
        preConfirm: function () {
            return new Promise(function (resolve) {
                var captcha = makeid(5);
                Swal.fire({
                    title: 'Verification',
                    html: 'Type the characters you see  bellow <h3 class="text-primary">'+captcha+'</h3>',
                    input: 'text',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    showLoaderOnConfirm: true,
                    confirmButtonColor: "#5b73e8",
                    cancelButtonColor: "#f46a6a",
                    preConfirm: function (text) {
                        return new Promise(function (resolve, reject) {
                            if(text == captcha){
                                $.get('/admin/programmes/delete/'+exam_id)
                                    .done(function (data) {
                                        if(data.code == 200){
                                            $("#exam"+event.target.parentNode.dataset.exam).closest('tr').fadeOut();
                                           exam_row.style.display = 'none';
                                            Swal.fire("#"+exam_id+" Deleted!", "Your "+data.msg+" has been deleted.", "success");
                                            resolve()
                                        }else{
                                            Swal.fire("#"+exam_id+" Error!",data.msg, "error");
                                            resolve()
                                        }
                                    })
                            }else{
                                Swal.fire("Mismatch!", "Your captcha was mismatched .", "warning");
                                reject()
                            }
                        })
                    },
                    allowOutsideClick: false
                })
            })
        }
    }]).catch(swal.noop)
});
