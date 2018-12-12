Chart.defaults.global.defaultFontFamily = 'pt mono';
Chart.defaults.global.defaultFontSize = 16;

var csrfToken = $('meta[name="csrf-token"]').attr("content");
$.ajax({
    url: 'index.php?r=rigs/mutual',
    method: 'post',
    data: {'type': 'json', '_csrf-backend': csrfToken},
    dataType: 'json',
    cache: false,
    success: function(data) {
        console.log(data);
    },
    error: function (errormessage) {
        console.log(errormessage);
    }
});


var mq = window.matchMedia('(min-width : 0) and (max-width : 768px)');






var colorArray = [
    "#3D9970", 
    "#0074D9", 
    "#AAAAAA", 
    "#FFDC00", 
    "#FF4136", 
    "#AAAAFF",
    "#F012BE",
    "#B10DC9",
];




function spliceMutual(data) {
    if (mq.matches) {
        var i = data.length;

        while (i--) {
           (i + 1) % 2 === 0 && data.splice(i, 1);
           (i + 1) % 3 === 0 && data.splice(i, 1);
        }

    }
    return data;
}

function mutualHashrate(data) {

    console.log(data);

    var ctx = document.getElementById('chart-mutual').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 50, 100, 300);
    var gradientBG = ctx.createLinearGradient(0, 50, 100, 300);



    gradient.addColorStop(0, 'rgba(60, 170, 255, .8)');   
    gradient.addColorStop(1, 'rgba(50, 50, 100, .7)');

    gradientBG.addColorStop(0, 'rgba(60, 160, 240, .3)');   
    gradientBG.addColorStop(1, 'rgba(80, 100, 190, .3)');

    var config = {

        type: 'line',
        data: {
            datasets: [
                {
                    label: 'Total Rate',
                    data: spliceMutual(data.rate),
                    pointBorderWidth: 0,
                    borderWidth: 1,
                    borderColor: '#f0ad4e',
                    // borderColor: colorArray[0] + 'AA',
                    pointHoverBorderWidth: 0,
                    pointBorderColor: 'transparent',
                    pointBackgroundColor: 'transparent',
                    pointHoverBorderColor: 'transparent',
                    pointHoverBackgroundColor: '#f0ad4e',
                    // backgroundColor: 'transparent',
                    backgroundColor: '#f0ad4e11',
                    pointRadius: 7,
                    pointHoverRadius: 7,
                    borderJoinStyle: 'round',
                },

            ],
            labels: spliceMutual(data.time),
        },
        options: optionsMutual,
    };


    var mixedChart = new Chart(ctx, config);

    // $('.count-hashrate').html(mixedChart.data.labels.length);
    // $('.count-hashrate').parent().fadeIn();

}



var optionsMutual = {


    legend: {
        display: false,
        position: 'bottom',
    },
    animation: {
        duration: 0.1
    },
    maintainAspectRatio: false,
    plugins: {
        filler: {
            propagate: true,
        }
    },
    elements: {
        line: {
            tension: 0.0,
        }
    },
    layout: {
        padding: {
            left: 0,
            right: 0,
            bottom: 0,
            top: 0,
        }
    },
    scales: {
        yAxes: [
            {
                ticks: {
                    // display: mq.matches ? false : true,
                    display: false,
                    fontSize: 12,
                    // min: 0,
                    // callback: function(label, index, labels) {
                    //     return label / 1000000;
                    // }
                },

                // afterFit: function(scaleInstance, data) {

                //     if (mq.matches) {
                //         scaleInstance.width = 0;
                //     } else {
                //         scaleInstance.width = 30;
                //     }
                // },
                // display: false,
                gridLines: {
                    display: false,
                    // drawBorder: mq.matches ? false : true,
                    drawBorder: false,
                    // borderDash: [6, 68.3],
                    zeroLineColor: 'transparent',
                },
            }
        ],
        xAxes: [
            {
                // display: false,
                gridLines: {
                    color: '#ffffff0c',
                    zeroLineColor: 'transparent',
                    // borderDash: [3, 30],
                    drawBorder: false,
                    zeroLineColor: 'transparent',
                    // display: false,
                },

                position: 'top',

                ticks: {
                    userCallback: function(item, index, all) {
                        if (!(index == 0) && !(index % 8) && !((index + 1) == all.length)) return item;
                    },
                    autoSkip: false,
                    maxRotation: 0,
                    minRotation: 0,
                    fontSize: 12,
                    // display: false
                }
            }
        ]
    },
    tooltips: {
        callbacks: {
            title: function(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
            },
            // labelTextColor: function(tooltipItem, chart){
            //     return colorArray[tooltipItem.datasetIndex];
            // },
        },
        mode: 'x-axis',
        xPadding: 20,
        yPadding: 20,
        cornerRadius: 0,
        // multiKeyBackground: '#000',
        titleFontStyle: 'normal',
        // borderWidth: 5,
        // borderColor: 'rgba(0,0,0,.1)',
        // backgroundColor: '#FFF',
        // backgroundColor: 'rgba(255,255,255,.9)',
        backgroundColor: 'rgba(50,50,50,.9)',
        titleFontSize: 16,
        // titleFontColor: 'rgba(80, 130, 200, 1)',
        titleFontColor: '#fff',
        // bodyFontColor: '#000',
        bodyFontColor: '#fff',
        bodyFontSize: 16,
        displayColors: false,
        position: 'custom',
        // yAlign: 'center',
        xAlign: 'right',
    }
};


Chart.Tooltip.positioners.custom = function(elements, position) {

    if (!elements.length) return false;

    return { x: 300, y: -15 };
}
