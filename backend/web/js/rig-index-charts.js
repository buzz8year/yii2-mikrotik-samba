Chart.defaults.global.defaultFontFamily = 'pt mono';
Chart.defaults.global.defaultFontSize = 16;



var mq = window.matchMedia('(min-width : 0) and (max-width : 768px)');


Chart.Tooltip.positioners.custom = function(elements, position) {
    if (!elements.length) {
        return false;
    }
    var offset = 0;
    // adjust the offset left or right depending on the event position
    // if (elements[0]._chart.width / 2 > position.x) {
    //     offset = 20;
    // } else {
    //     offset = -20;
    // }
    return {
        x: 127,
        y: -15,
        // x: position.x + offset,
        // y: position.y
    }
}



var colorArray = [
    "#0074D9", 
    "#3D9970", 
    "AAAAAA", 
    "#FFDC00", 
    "#FF4136", 
    "#85144b",
    "#F012BE",
    "#B10DC9",
];






function rigHashrate(data, kee) {

    // $(document).on('mouseover', '.chart-container', function(){
    //     $(this).closest('.table tr').addClass('o');
    // }).on('mouseleave', '.chart-container', function(){
    //     $(this).closest('.table tr').removeClass('o');
    // });

    console.log(data);

    // var ctx = document.getElementById('chart-hashrate-' + kee).getContext('2d');
    var ctx = document.getElementById('chart-hashrate-' + kee).getContext('2d');
    var gradient = ctx.createLinearGradient(0, 50, 100, 300);
    var gradientBG = ctx.createLinearGradient(0, 50, 100, 300);



    // gradient.addColorStop(0, 'rgba(35, 155, 145, .9)');   
    // gradient.addColorStop(1, 'rgba(45, 185, 165, .8)');
    gradient.addColorStop(0, 'rgba(60, 170, 255, .8)');   
    gradient.addColorStop(1, 'rgba(50, 50, 100, .7)');

    gradientBG.addColorStop(0, 'rgba(60, 160, 240, .3)');   
    gradientBG.addColorStop(1, 'rgba(80, 100, 190, .3)');

    var config = {

        type: 'line',
        data: {
            datasets: [
                {
                    label: 'GPU0',
                    data: data.rate0,
                    borderWidth: 3,
                    pointBorderWidth: 0,
                    borderColor: colorArray[0] + 'AA',
                    pointHoverBorderWidth: 3,
                    pointBorderColor: 'transparent',
                    pointHoverBorderColor: colorArray[0] + 'AA',
                    pointHoverBackgroundColor: '#ffffff',
                    backgroundColor: 'transparent',
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    borderJoinStyle: 'round',
                },
                {
                    label: 'GPU1',
                    data: data.rate1,
                    borderWidth: 3,
                    pointBorderWidth: 0,
                    borderColor: colorArray[1] + 'AA',
                    pointHoverBorderWidth: 3,
                    pointBorderColor: 'transparent',
                    pointHoverBorderColor: colorArray[1] + 'AA',
                    pointHoverBackgroundColor: '#ffffff',
                    backgroundColor: 'transparent',
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    borderJoinStyle: 'round',
                },
                {
                    label: 'GPU2',
                    data: data.rate2,
                    borderWidth: 3,
                    pointBorderWidth: 0,
                    borderColor: colorArray[2] + 'AA',
                    pointHoverBorderWidth: 3,
                    pointBorderColor: 'transparent',
                    pointHoverBorderColor: colorArray[2] + 'AA',
                    pointHoverBackgroundColor: '#ffffff',
                    backgroundColor: 'transparent',
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    borderJoinStyle: 'round',
                },
                {
                    label: 'GPU3',
                    data: data.rate3,
                    borderWidth: 3,
                    pointBorderWidth: 0,
                    borderColor: colorArray[3] + 'AA',
                    pointHoverBorderWidth: 3,
                    pointBorderColor: 'transparent',
                    pointHoverBorderColor: colorArray[3] + 'AA',
                    pointHoverBackgroundColor: '#ffffff',
                    backgroundColor: 'transparent',
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    borderJoinStyle: 'round',
                },
                {
                    label: 'GPU4',
                    data: data.rate4,
                    borderWidth: 3,
                    pointBorderWidth: 0,
                    borderColor: colorArray[4] + 'AA',
                    pointHoverBorderWidth: 3,
                    pointBorderColor: 'transparent',
                    pointHoverBorderColor: colorArray[4] + 'AA',
                    pointHoverBackgroundColor: '#ffffff',
                    backgroundColor: 'transparent',
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    borderJoinStyle: 'round',
                },
                {
                    label: 'GPU5',
                    data: data.rate5,
                    borderWidth: 3,
                    pointBorderWidth: 0,
                    borderColor: colorArray[5] + 'AA',
                    pointHoverBorderWidth: 3,
                    pointBorderColor: 'transparent',
                    pointHoverBorderColor: colorArray[5] + 'AA',
                    pointHoverBackgroundColor: '#ffffff',
                    backgroundColor: 'transparent',
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    borderJoinStyle: 'round',
                },
                {
                    label: 'GPU6',
                    data: data.rate6,
                    borderWidth: 3,
                    pointBorderWidth: 0,
                    borderColor: colorArray[6] + 'AA',
                    pointHoverBorderWidth: 3,
                    pointBorderColor: 'transparent',
                    pointHoverBorderColor: colorArray[6] + 'AA',
                    pointHoverBackgroundColor: '#ffffff',
                    backgroundColor: 'transparent',
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    borderJoinStyle: 'round',
                },
                {
                    label: 'GPU7',
                    data: data.rate7,
                    borderWidth: 3,
                    pointBorderWidth: 0,
                    borderColor: colorArray[7] + 'AA',
                    pointHoverBorderWidth: 3,
                    pointBorderColor: 'transparent',
                    pointHoverBorderColor: colorArray[7] + 'AA',
                    pointHoverBackgroundColor: '#ffffff',
                    backgroundColor: 'transparent',
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    borderJoinStyle: 'round',
                },
                // {
                //     label: 'GPU8',
                //     data: data.rate8,
                //     borderWidth: 3,
                //     pointBorderWidth: 0,
                //     borderColor: colorArray[8] + 'AA',
                //     pointHoverBorderWidth: 3,
                //     pointBorderColor: 'transparent',
                //     pointHoverBorderColor: colorArray[8] + 'AA',
                //     pointHoverBackgroundColor: '#ffffff',
                //     backgroundColor: 'transparent',
                //     pointRadius: 5,
                //     pointHoverRadius: 5,
                //     borderJoinStyle: 'round',
                // },
                // {
                //     label: 'Reported',
                //     // yAxisID: 'B',
                //     data: [],
                //     // data: data.reportedHashrate ? data.reportedHashrate.slice(data.reportedHashrate.length - 40, data.reportedHashrate.length) : [],
                //     // data: data.reportedHashrate,

                //     // backgroundColor: 'rgba(255, 99, 132, .8)',
                //     backgroundColor: 'transparent',
                //     borderWidth: 3,
                //     borderColor: '#777',
                //     pointBorderWidth: 1.3,
                //     pointBackgroundColor: '#777',
                //     pointRadius: 1.3,
                //     pointHoverRadius: 5,
                // },
                // {
                //     label: 'Average',
                //     // yAxisID: 'B',
                //     data: [],
                //     // data: data.averageHashrate ? data.averageHashrate.slice(data.averageHashrate.length - 40, data.averageHashrate.length) : [],
                //     // data: data.averageHashrate,

                //     backgroundColor: 'transparent',
                //     borderWidth: 3,
                //     borderColor: '#777',
                //     // pointBackgroundColor: '#3cba9f',
                //     pointBackgroundColor: 'rgba(60, 200, 180, 1)',
                //     pointBorderWidth: 0,
                //     pointRadius: 0,
                //     pointHoverRadius: 0,
                //     // borderDash: [2, 3],
                //     borderCapStyle: 'round'
                // },

            ],
            // labels: data.time ? (mq.matches ? data.time.slice(data.time.length - 50, data.time.length) : data.time.slice(data.time.length / 2, data.time.length)) : [],
            labels: data.time,
            // labels: data.time.slice(data.time.length - 40, data.time.length),
        },
        options: optionsHashrate,
    };


    var mixedChart = new Chart(ctx, config);

    $('.count-hashrate').html(mixedChart.data.labels.length);
    $('.count-hashrate').parent().fadeIn();

}









// function rigShares(data) {

//     if (data.validShares) {
//         var ctx = document.getElementById('chart-shares').getContext('2d');
//         var gradient = ctx.createLinearGradient(0, 150, 250, 300);
//         var gradientBG = ctx.createLinearGradient(0, 150, 250, 200);

//         gradient.addColorStop(0, 'rgba(60, 160, 240, .9)');   
//         gradient.addColorStop(1, 'rgba(80, 90, 160, .9');

//         gradientBG.addColorStop(0, 'rgba(60, 160, 240, .7)');   
//         gradientBG.addColorStop(1, 'rgba(80, 100, 190, .7)');

//         var mixedChart = new Chart(ctx, {
//             type: 'bar',
//             data: {
//                 datasets: [
//                     // {
//                     //     label: 'Stale',
//                     //     // yAxisID: 'B',
//                     //     data: data.staleShares,
//                     //     backgroundColor: 'transparent',
//                     //     borderWidth: 3,
//                     // },
//                     {
//                         label: 'Valid',
//                         // yAxisID: 'B',
//                         // data: data.validShares.slice(data.validShares.length - 25, data.validShares.length),
//                         data: data.validShares.slice(data.validShares.length * 0.75, data.validShares.length),
//                         // data: data.validShares,
//                         // backgroundColor: 'transparent',
//                         borderWidth: 0,
//                         borderColor: 'rgba(90, 100, 155, 0)',
//                         backgroundColor: mq.matches ? gradientBG : gradient,
//                         hoverBackgroundColor: 'rgba(80, 90, 190, .6)',
//                         // backgroundColor: 'rgba(30, 150, 210, .8)',
//                     },
//                 ],
//                 // labels: data.time.slice(data.time.length - 25, data.time.length),
//                 // labels: data.time.slice(data.time.length / 2, data.time.length),
//                 labels: mq.matches ? data.time.slice(data.time.length - 32, data.time.length) : data.time.slice(data.time.length * 0.75, data.time.length),
//                 // labels: data.time,
//             },
//             options: optionsShares,

//         });

//         $('.count-shares').html(mixedChart.data.labels.length);
//         $('.count-shares').parent().fadeIn();
//     }
// }














var optionsHashrate = {


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
            tension: .3,
        }
    },
    layout: {
        padding: {
            // left: 22,
            // right: 22,
            // bottom: 50,
            // top: 20,
        }
    },
    scales: {
        yAxes: [
            {
                ticks: {
                    // display: mq.matches ? false : true,
                    fontSize: 12,
                    fontColor: '#ccc',
                    // min: 13000,
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
                    // display: false,
                    color: '#ddd',
                    // drawBorder: mq.matches ? false : true,
                    drawBorder: false,
                    borderDash: [8, 4],
                    zeroLineColor: 'transparent',
                },
            }
        ],
        xAxes: [
            {
                // display: false,
                gridLines: {
                    color: 'rgba(0,0,0,0.035)',
                    zeroLineColor: 'transparent',
                    borderDash: [4, 4],
                    drawBorder: false,
                    // display: false,
                },

                ticks: {
                    fontSize: 12,
                    // display: false
                }
            }
        ]
    },
    tooltips: {
        callbacks: {
            labelColor: function(tooltipItem, chart) {
                    return {
                        borderColor: 'rgb(255, 0, 0)',
                        backgroundColor: 'rgb(255, 0, 0)'
                    }
                },
            title: function(tooltipItem, data) {
                return;
                // return data['labels'][tooltipItem[0]['index']];
            },
            labelTextColor: function(tooltipItem, chart){
                return colorArray[tooltipItem.datasetIndex];
            },
            // label: function(tooltipItem, data) {
            //     // var multiLine = [(datasetCurrent['data'][tooltipItem['index']] / 1000000).toFixed(2) + ' MH/s'];
            //     // multiLine.push((datasetAverage['data'][tooltipItem['index']] / 1000000).toFixed(2) + ' MH/s (Avg.)');
            //     // multiLine.push((datasetReported['data'][tooltipItem['index']] / 1000000).toFixed(2) + ' MH/s (Reported)');

            //     // var multiLine = [];
            //     // var oneLine1 = '';
            //     // var oneLine2 = '';
            //     // var oneLine3 = '';

            //     for (i = 0; i < 8; i++) {
            //         var dataset = data['datasets'][i];
            //         // if ((dataset.data).length) multiLine.push((dataset['data'][tooltipItem['index']] / 1).toFixed(2) + ' MH/s');
            //         // if ((dataset.data).length) {
            //         //     if (i < 3) {
            //         //         oneLine1 = oneLine1 + 'GPU' + i + ': ' + (dataset['data'][tooltipItem['index']] / 1).toFixed(2) + ' MH/s - ';
            //         //     }
            //         //     if (i > 2 && i < 6) {
            //         //         oneLine2 = oneLine2 + (dataset['data'][tooltipItem['index']] / 1).toFixed(2) + ' MH/s - ';
            //         //     }
            //         //     else {
            //         //         oneLine3 = oneLine3 + (dataset['data'][tooltipItem['index']] / 1).toFixed(2) + ' MH/s - ';
            //         //     }
            //         // } 
            //     }

            //     // bodyLines.forEach(function(body, i) {
            //     //     var colors = tooltip.labelColors[i];
            //     //     var style = 'background:' + colors.backgroundColor;
            //     //     style += '; border-color:' + colors.borderColor;
            //     //     style += '; border-width: 2px';
            //     //     var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
            //     //     innerHtml += '<div><span>' + span + body + '</span></div>';
            //     // });

            //     // multiLine.push(oneLine1, oneLine2, oneLine3);
            //     // multiLine.push((dataset['data'][tooltipItem['index']] / 1).toFixed(2) + ' MH/s');

            //     // var label = data.datasets[tooltipItem.datasetIndex].label;
            //     // return multiLine;
            //     // return oneLine;

            //     var label = (dataset['data'][tooltipItem['index']] / 1).toFixed(2) + ' MH/s';
            //     return label;
            // },
        },
        mode: 'x-axis',
        xPadding: 15,
        yPadding: 15,
        cornerRadius: 0,
        // multiKeyBackground: '#000',
        titleFontStyle: 'normal',
        // borderWidth: 5,
        // borderColor: 'rgba(0,0,0,.1)',
        // backgroundColor: '#FFF',
        // backgroundColor: 'rgba(255,255,255,.9)',
        backgroundColor: 'rgba(255,255,255,.9)',
        titleFontSize: 16,
        // titleFontColor: 'rgba(80, 130, 200, 1)',
        titleFontColor: '#444',
        // bodyFontColor: '#000',
        bodyFontColor: '#444',
        bodyFontSize: 15,
        displayColors: false,
        position: 'custom',
        // yAlign: 'center',
        xAlign: 'right',
    }
};



















var optionsShares = {

    legend: {
        display: false,
        position: 'bottom',
    },
    animation: {
        duration: 0
    },
    maintainAspectRatio: false,
    // chartArea: {
    //     backgroundColor: '#5ad'
    // },
    plugins: {
        filler: {
            propagate: true,
        }
    },
    elements: {
        line: {
            tension: 0,
        }
    },
    layout: {
        padding: {
            // left: 22,
            // right: 22,
            // bottom: 22,
            top: 22,
        }
    },
    scales: {
        yAxes: [
            {
                // display: false,
                gridLines: {
                    // display: false
                },
                ticks: {
                    display: false,
                    fontSize: 12,
                    min: 0,
                },
                afterFit: function(scaleInstance) {
                    if (mq.matches) {
                        scaleInstance.width = 0;
                    } else {
                        // scaleInstance.width = 63;
                        scaleInstance.width = 30;
                    }
                },
                gridLines: {
                    display: true,
                    color: '#eee',
                    drawBorder: false,
                    zeroLineColor: 'transparent',
                },
            }
        ],
        xAxes: [
            {
                display: false,
                // gridLines: {
                //     display: false,
                // },
                // ticks: {
                //     display: false
                // }
            }
        ]
    },
    tooltips: {
        callbacks: {
            title: function(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
            },
            // label: function(tooltipItem, data) {
            //     var dataset = data['datasets'][0];
            //     return Math.round(dataset['data'][tooltipItem['index']] / 1000000) + ' MH/s';
            //     // return data['datasets'][0]['data'][tooltipItem['index']];
            // },
        },
        xPadding: 15,
        yPadding: 15,
        cornerRadius: 0,
        // multiKeyBackground: '#000',
        titleFontStyle: 'normal',
        // borderWidth: 5,
        // borderColor: 'rgba(0,0,0,.1)',
        // backgroundColor: '#FFF',
        // backgroundColor: 'rgba(255,255,255,.9)',
        backgroundColor: 'rgba(30,30,30,.8)',
        titleFontSize: 16,
        // titleFontColor: 'rgba(80, 130, 200, 1)',
        titleFontColor: '#FFF',
        // bodyFontColor: '#000',
        bodyFontColor: '#FFF',
        bodyFontSize: 14,
        displayColors: false,
        // yAlign: 'bottom',
        // xAlign: 'center',
    }
};








function rigAccruals(data) {

    if (data) {
        var ctx = document.getElementById('chart-accruals').getContext('2d');
        var gradient = ctx.createLinearGradient(0, 150, 250, 400);
        var gradientBG = ctx.createLinearGradient(0, 150, 250, 400);

        gradient.addColorStop(0, 'rgba(60, 160, 240, .95)');   
        gradient.addColorStop(1, 'rgba(80, 90, 150, .95)');

        gradientBG.addColorStop(0, 'rgba(60, 160, 240, .5)');   
        gradientBG.addColorStop(1, 'rgba(80, 100, 190, .5)');

        var chartAccruals = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Accruals',
                        data: data.accruals,
                        borderWidth: 1.2,
                        borderColor: gradient,
                        backgroundColor : gradientBG,
                        pointRadius: 6,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointHoverBackgroundColor: gradient,
                        pointBorderWidth: 1.2,
                        pointBorderColor: gradient,
                        pointHoverBorderColor: gradient,
                    },
                ],
                labels: data.time
            },
            options: optionsAccruals,

        });

        // chartAccruals.config.options.scales.yAxes[0].ticks.min = Math.min.apply(null, data.accruals) * 0.996;
        // chartAccruals.config.options.scales.yAxes[0].ticks.max = Math.max.apply(null, data.accruals);
        // chartAccruals.update();
    }
}


var optionsAccruals = {

    legend: {
        display: false,
        position: 'bottom',
    },
    animation: {
        // duration: 0
    },
    maintainAspectRatio: false,
    plugins: {
        filler: {
            propagate: true,
        }
    },
    elements: {
        line: {
            tension: 0,
        }
    },
    layout: {
        padding: {
            // left: 22,
            right: 8,
            // bottom: 22,
            top: 80,
        }
    },
    scales: {
        yAxes: [
            {
                // display: false,
                gridLines: {
                    // display: false
                },
                ticks: {
                    display: false,
                    fontSize: 12,
                    min: 0,
                    // min: 0.0075,
                },
                afterFit: function(scaleInstance) {
                    // scaleInstance.width = 55;
                },
                gridLines: {
                    display: true,
                    color: '#eee',
                    drawBorder: false,
                    zeroLineColor: 'transparent',
                },
            }
        ],
        xAxes: [
            {
                display: false,
                gridLines: {
                    display: false,
                },
                ticks: {
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
            // label: function(tooltipItem, data) {
            //     var dataset = data['datasets'][0];
            //     return Math.round(dataset['data'][tooltipItem['index']] / 1000000) + ' MH/s';
            //     // return data['datasets'][0]['data'][tooltipItem['index']];
            // },
        },
        xPadding: 15,
        yPadding: 15,
        cornerRadius: 0,
        titleFontStyle: 'normal',
        backgroundColor: 'rgba(30,30,30,.8)',
        titleFontSize: 16,
        titleFontColor: '#FFF',
        // bodyFontColor: '#000',
        bodyFontColor: '#FFF',
        bodyFontSize: 14,
        displayColors: false,
        yAlign: 'bottom',
        // xAlign: 'center',
    }
};