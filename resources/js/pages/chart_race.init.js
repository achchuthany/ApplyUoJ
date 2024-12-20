$('#select_all').on('click',function(){
        $("#programme_id > option").prop("selected", "selected");
        $("#programme_id").trigger("change");
});


$('#apply').on('click', function() {
    var programme_id= $('#programme_id').val();
    var academic_year_id= $('#academic_year_id').val();
    var enroll_status= $('#enroll_status').val();
    if(programme_id.length ==0 || academic_year_id.length ==0 || enroll_status.length ==0){
        Swal.fire("Warning", 'Select at least one value from each selection', "warning");

    }else{
        getData(programme_id,academic_year_id,enroll_status);
    }
});

//RACE CHART
var barChartData = {
    labels: [],
    datasets: [{
        label: 'Number of Students',
        backgroundColor: [
            "#8E0D37",
            "#EC7500",
            "#00524D",
            "#FFBF24"

        ],
        hoverBackgroundColor: [
            "#8E0D37",
            "#EC7500",
            "#00524D",
            "#FFBF24"

        ],
        hoverBorderColor: "#ececec",
        borderWidth: 1,
        data: []
    }]
};

var ctx = document.getElementById("pie").getContext("2d");
var myRace = new Chart(ctx, {
    type: 'pie',
    data: barChartData,
    options: {
        elements: {
            rectangle: {
                borderWidth: 1,
                borderColor: '#c1c1c1',
                borderSkipped: 'bottom'
            }
        },
        responsive: true,
        title: {
            display: false,
            text: 'Analytics of Race'
        }
    }
});

//END RACE CHART

//religion chart
var religionChartData = {
    labels: [],
    datasets: [{
        label: 'Number of Students',
        backgroundColor: [
            "#8E0D37",
            "#EC7500",
            "#FFBF24",
            "#00524D",
            "#0dbdf1"


        ],
        hoverBackgroundColor: [
            "#8E0D37",
            "#EC7500",
            "#FFBF24",
            "#00524D",
            "#0dbdf1"

        ],
        hoverBorderColor: "#ececec",
        borderWidth: 1,
        data: []
    }]
};
var religion_ctx = document.getElementById("religion_chart").getContext("2d");
var myReligion = new Chart(religion_ctx, {
    type: 'pie',
    data: religionChartData,
    options: {
        elements: {
            rectangle: {
                borderWidth: 1,
                borderColor: '#c1c1c1',
                borderSkipped: 'bottom'
            }
        },
        responsive: true,
        title: {
            display: false,
            text: 'Analytics of Race'
        }
    }
});
//end religion chart

function getData(programme_id,academic_year_id,enroll_status){
    $.post(url,{
        'programme_id':programme_id,
        'academic_year_id':academic_year_id,
        'enroll_status':enroll_status,
        '_token':_token
    }).done(function (data) {
        let html = html2 =  "";
        for(let i=0;i<data.label.length;i++){
            html +=
                "<tr>" +
                "<td>"+data.label[i]+"</td>" +
                "<td class='text-center'>"+data.data[i]+"</td>" +
                "<td>"+((data.data[i]/data.total)*100).toFixed(2)+"%</td>" +
                "</tr>";
        }
        $("#table_data").html(html);

        for(let i=0;i<data.religion_label.length;i++){
            html2 +=
                "<tr>" +
                "<td>"+data.religion_label[i]+"</td>" +
                "<td class='text-center'>"+data.religion_count[i]+"</td>" +
                "<td>"+((data.religion_count[i]/data.total)*100).toFixed(2)+"%</td>" +
                "</tr>";
        }
        $("#religion_table_data").html(html2);

        //UPDATE RACE CHART
        myRace.data.labels = data.label;
        myRace.data.datasets[0].data = data.data;
        myRace.update();

        //UPDATE RELIGION CHART
        myReligion.data.labels = data.religion_label;
        myReligion.data.datasets[0].data = data.religion_count;
        myReligion.update();

    });
}
