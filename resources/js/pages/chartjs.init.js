$(document).ready(function () {
    changeData($('#ay').val());
});
$('#ay').on('change', function() {
    changeData(this.value );
});
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
function changeData(value) {
    var url = "/home/data/"+value
    $.get(url, function(data, status){
        var programme =  data.programme;

        var count = data.count;
        var colorsA = [];
        for(var i=0;i<count.length;i++)
            colorsA[i]=getRandomColor();

        var barChartData = {
            labels: programme,
            datasets: [{
                label: 'Number of Students',
                backgroundColor: colorsA,
                borderColor: colorsA,
                borderWidth: 1,
                hoverBackgroundColor: "rgba(48,48,48,0.9)",
                hoverBorderColor: "rgba(3,3,3,0.9)",
                data: count
            }]
        };
        var ctx = document.getElementById("bar").getContext("2d");
        window.myBar = new Chart(ctx, {
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
                    text: 'Students Statics'
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display:false
                        },
                        barPercentage: 0.2
                    }],
                    yAxes: [{
                        gridLines: {
                            display:false
                        },
                        ticks: {
                            min: 0,
                            stepSize: 5
                        }
                    }]
                }
            }
        });
    });
}
