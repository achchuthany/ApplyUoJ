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
            '#3366CC',
            '#DC3912',
            '#FF9900',
            '#109618',
            '#990099',
            '#3B3EAC',
            '#0099C6',
            '#DD4477',
            '#66AA00',
            '#B82E2E',
            '#316395',
            '#994499',
            '#22AA99',
            '#AAAA11',
            '#6633CC',
            '#E67300',
            '#8B0707',
            '#329262',
            '#5574A6',
            '#3B3EAC',
            '#0F4D92',
            '#8F00FF',
            '#008080',
            '#4682B4',
            '#CF71AF'

        ],
        hoverBackgroundColor: "#323232",
        hoverBorderColor: "#ececec",
        borderWidth: 1,
        data: []
    }]
};

var ctx = document.getElementById("district_chart").getContext("2d");
var genderChart = new Chart(ctx, {
    type: 'bar',
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

            '#3366CC',
            '#DC3912',
            '#FF9900',
            '#109618',
            '#990099',
            '#3B3EAC',
            '#0099C6',
            '#DD4477',
            '#66AA00',
            '#B82E2E',
            '#316395',
            '#994499',
            '#22AA99',
            '#AAAA11',
            '#6633CC',
            '#E67300',
            '#8B0707',
            '#329262',
            '#5574A6',
            '#3B3EAC',
            '#0F4D92',
            '#8F00FF',
            '#008080',
            '#4682B4',
            '#CF71AF'


        ],
        hoverBackgroundColor:"#181818",
        hoverBorderColor: "#ececec",
        borderWidth: 1,
        data: []
    }]
};
var religion_ctx = document.getElementById("province_chart").getContext("2d");
var civilChart = new Chart(religion_ctx, {
    type: 'bar',
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
        for(let i=0;i<data.districts_count.length;i++){
            html +=
                "<tr>" +
                "<td>"+data.districts_label[i]+"</td>" +
                "<td class='text-center'>"+data.districts_count[i]+"</td>" +
                "<td>"+((data.districts_count[i]/data.total)*100).toFixed(2)+"%</td>" +
                "</tr>";
        }
        $("#district_table_data").html(html);

        for(let i=0;i<data.provinces_count.length;i++){
            html2 +=
                "<tr>" +
                "<td>"+data.provinces_label[i]+"</td>" +
                "<td class='text-center'>"+data.provinces_count[i]+"</td>" +
                "<td>"+((data.provinces_count[i]/data.total)*100).toFixed(2)+"%</td>" +
                "</tr>";
        }
        $("#province_table_data").html(html2);

        //UPDATE RACE CHART
        genderChart.data.labels = data.districts_label;
        genderChart.data.datasets[0].data = data.districts_count;
        genderChart.update();

        //UPDATE RELIGION CHART
        civilChart.data.labels = data.provinces_label;
        civilChart.data.datasets[0].data = data.provinces_count;
        civilChart.update();

    });
}
