function setDate(){
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $("#date").val(today);
}
function generate(){
    var aid = $('#academic_year_id').val()
    var pid = $('#programme_id').val()

    $.ajax({
        url: "/admin/enroll/change/get/reg/"+pid+"/"+aid,
        type: "get",
        success: function(data) {
            $('#reg_no').val(data.reg_no);
            $('#index_no').val(data.index_no);
        }
    });
}

$('.mdi-autorenew').on('click',function (){
    generate();
    setDate();
});
$('#academic_year_id').on('change', function() {
    generate();
    setDate();
});
