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
            "#084edb",
            "#f61b8c",

        ],
        hoverBackgroundColor: [
            "#084edb",
            "#f61b8c",

        ],
        hoverBorderColor: "#ececec",
        borderWidth: 1,
        data: []
    }]
};

var ctx = document.getElementById("gender_chart").getContext("2d");
var genderChart = new Chart(ctx, {
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
var religion_ctx = document.getElementById("civil_chart").getContext("2d");
var civilChart = new Chart(religion_ctx, {
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
        for(let i=0;i<data.gender_count.length;i++){
            html +=
                "<tr>" +
                "<td>"+data.gender_label[i]+"</td>" +
                "<td class='text-center'>"+data.gender_count[i]+"</td>" +
                "<td>"+((data.gender_count[i]/data.total)*100).toFixed(2)+"%</td>" +
                "</tr>";
        }
        $("#gender_table_data").html(html);

        for(let i=0;i<data.civil_status_count.length;i++){
            html2 +=
                "<tr>" +
                "<td>"+data.civil_status_label[i]+"</td>" +
                "<td class='text-center'>"+data.civil_status_count[i]+"</td>" +
                "<td>"+((data.civil_status_count[i]/data.total)*100).toFixed(2)+"%</td>" +
                "</tr>";
        }
        $("#civil_table_data").html(html2);

        //UPDATE RACE CHART
        genderChart.data.labels = data.gender_label;
        genderChart.data.datasets[0].data = data.gender_count;
        genderChart.update();

        //UPDATE RELIGION CHART
        civilChart.data.labels = data.civil_status_label;
        civilChart.data.datasets[0].data = data.civil_status_count;
        civilChart.update();

    });
}
