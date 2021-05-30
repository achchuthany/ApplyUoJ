var $modal = $('#modal');
var image = document.getElementById('image');
var document_student_id = $('#document_student_id').val()
// console.log(document_student_id);
var cropper;
$("body").on("change", "#profileImage", function(e){
    var files = e.target.files;
    var done = function (url) {
        image.src = url;
        $modal.modal('show');
    };
    var reader;
    var file;
    var url;
    if (files && files.length > 0) {
        file = files[0];
        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
                done(reader.result);
            };
            reader.readAsDataURL(file);
        }
    }
});

$modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
        aspectRatio: 35 / 45,
        viewMode: 1,
        preview: '.preview',
        dragMode: 'crop',
        movable : false,
        scalable: false,
        zoomable: false
    });
}).on('hidden.bs.modal', function () {
    cropper.destroy();
    cropper = null;
});

$("#crop").click(function(){
    canvas = cropper.getCroppedCanvas({
        width: 826,
        height: 1062,
        fillColor: '#fff',
        imageSmoothingEnabled: false,
        imageSmoothingQuality: 'high',
    });
    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
            var base64data = reader.result;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/registration/student/uploadProfileImage",
                data: {
                    "student_id":document_student_id,
                    "_token": _token,
                    'image': base64data,

                },
                success: function(data) {
                    console.log(data.isChecked);
                    $modal.modal('hide');
                    if (data.isChecked){
                        Swal.fire({
                            title: 'Success',
                            text: "You have successfully uploaded your profile image.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Continue upload documents',
                            imageUrl: '/registration/student/image/' + data.success,
                            imageWidth: 150,
                            imageAlt: 'Custom image',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace("/registration/7");
                            }
                        })
                    }else{
                        Swal.fire("Upload failed",'Your profile picture is not fully uploaded. Upload again!', "error");
                    }
                }
            });
        }
    });
})
