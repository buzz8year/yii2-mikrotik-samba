rawHtml(getFirstRig());
rawScroll();

setInterval(function () {
    rawHtml(getFirstRig());
}, 15000);




$(document).ready(function(){
    var id = $('#raw-html').attr('data-id');
    $('.click-rig[data-rig=' + id + ']').addClass('selected');

    setTimeout(function(){
        $('.enable-reboot, .enable-eres').addClass('enable-on');
    }, 2000);

    var sep = '<div class="separator"></div>';

    $('table tr').each(function(){
        shelf = parseInt($(this).find('.gpu-state').html());
        if (shelf === 101 || shelf === 201 || shelf === 301) {
            $(this).before($(sep));
        }
    });
});



$(document).on('click', '.show-disabled', function(){
    $('.search-rig').click();
});



// $(document).on('click', '.enable-switch, .enable-change', function(){
$(document).on('click', '#act-switch', function(){
    var s = $('.enable-switch');
    var state = 0;

    if (s.hasClass('enable-off')) {
        state = 1;
    }

    if (confirm('You\'re a moment away from ' + (state ? 'en' : 'dis') + 'abling the rig - proceed?')) {
        $.ajax({
            url: 'index.php?r=rigs/state',
            method: 'post',
            data: {'id': getFirstRig(), 'state': state, '_csrf-backend': getCsrf()},
            dataType: 'json',
            cache: false,
            error: function(data){
                console.log(data);
            },
            success: function(data){
                console.log(data);
                if (data) {
                    if (data == 1) {
                        s.removeClass('enable-off').addClass('enable-on');
                    } else {
                        s.removeClass('enable-on').addClass('enable-off');
                    }
                }
            },       
        });
    }
});



$(document).on('click', '#act-reboot:not(.enable-reboot-mute)', function(){

    var el = $('.enable-reboot');
    var state = 0;

    if (el.hasClass('enable-off')) {
        state = 1;
    }

    if (el.hasClass('enable-off')) {
        if (el.hasClass('enable-canceled')) {

        } else {
            if (confirm('Abort rebooting ?')) {
                    rebootAjax(el, state);
            }
        }

    } else {
        if (confirm('If the rig is working & net connection is ok, then this action will succeed. \
            ATTENTION! You\'re a moment away from REBOOTING the rig - PROCEED? \
            You will have 10 sec to cancel.')) {
                rebootAjax(el, state);
        }
    }
});



$(document).on('click', '#act-eres:not(.enable-eres-mute)', function(){

    var el = $('.enable-eres');
    var state = 0;

    if (el.hasClass('enable-off')) {
        state = 1;
    }

    if (el.hasClass('enable-off')) {
        if (el.hasClass('enable-canceled')) {

        } else {
            if (confirm('Abort rebooting ?')) {
                    eresAjax(el, state);
            }
        }

    } else {
        if (confirm('You\'re a moment away from ADDING "-eres 0" to Claymore .bat file - PROCEED?')) {
                eresAjax(el, state);
        }
    }
});



$(document).on('click', '.click-rig', function(){
    var id = $(this).attr('data-rig');

    $('.selected').removeClass('selected');
    $(this).addClass('selected');

    $.ajax({
        url: 'index.php?r=rigs/info',
        method: 'post',
        data: {'id': id, '_csrf-backend': getCsrf()},
        dataType: 'json',
        cache: false,
        error: function(data){
            console.log(data);
        },
        success: function(data){
            // console.log(data);
            rigExpand(data);
        },
    });

    $('html, body').animate({ scrollTop: 0 }, 'slow', function () {
    });
});



$(document).on('click', '.link-raw', function(){
    var id = $('#raw-html').attr('data-id');
    window.open(
        'index.php?r=rigs/raw&id=' + id,
        '_blank'
    );
});




// function countSec() {
//     var el = document.getElementById('count-sec');
//     var sec = el.innerText;

    
//     if (sec == 15) {

//         var timer = setInterval(function() {
//             sec -= 1;
//             if (sec < 10) {
//                 sec = ('0' + sec).slice(-2);
//             }

//             el.innerText = sec;
//             if (sec <= 0) {
//                 clearInterval(timer);
//                 sec = 15;
//             }
            
//         }, 1000);

//     }

// }




$(document).on('click', '#act-config', function(){
    var el = $('.enable-eres');
    configAjax(el);
});




function configAjax(elate) {
    $.ajax({
        url: 'index.php?r=rigs/config',
        method: 'post',
        data: {'id': getFirstRig(), '_csrf-backend': getCsrf()},
        dataType: 'json',
        cache: false,
        error: function(data){
            console.log(data);
        },
        beforeSend: function(){

            // el.removeClass('enable-on').addClass('enable-off');
        },
        success: function(data){
            console.log(data);
            $('#modal-config .modal-body').html(data);
            $('#modal-config').modal('show');
        },       
    });
}




function eresAjax(el, state) {
    $.ajax({
        url: 'index.php?r=rigs/eres',
        method: 'post',
        data: {'id': getFirstRig(), 'state': state, 'abort': state, '_csrf-backend': getCsrf()},
        dataType: 'json',
        cache: false,
        error: function(data){
            console.log(data);
        },
        beforeSend: function(){
            el.removeClass('enable-on').addClass('enable-off');
        },
        success: function(data){
            alert(data['response']);
            console.log(data);

            if (data && data['error'] == 0) {
                el.removeClass('enable-canceled enable-off enable-eres-mute').addClass('enable-on');
            }
            else {
                el.addClass('enable-eres-mute');
            }
        },       
    });
}


function rebootAjax(el, state) {
    $.ajax({
        url: 'index.php?r=rigs/reboot',
        method: 'post',
        data: {'id': getFirstRig(), 'state': state, 'abort': state, '_csrf-backend': getCsrf()},
        dataType: 'json',
        cache: false,
        error: function(data){
            console.log(data);
        },
        success: function(data){
            console.log(data);

            if (data && data['error'] == 0) {

                if (data['state'] == 1) {

                    if (data['abort'] == 1) {

                        el.addClass('enable-canceled');
                        setTimeout(function() {
                            el.removeClass('enable-canceled enable-off enable-reboot-mute');
                            el.addClass('enable-on');
                        }, 3000);

                    } else {

                        // el.removeClass('enable-off').addClass('enable-on');
                    }

                } else {

                    el.removeClass('enable-on').addClass('enable-off');
                    // setTimeout(function() {
                    //     el.addClass('enable-reboot-mute');
                    // }, 3000);
                }
            }
            else {
                el.addClass('enable-reboot-mute');
            }
        },       
    });
}


function getCsrf() {
    return $('meta[name=\'csrf-token\']').attr('content');
}


function rawScroll() {
    var e = document.getElementById('raw-html');
    e.scrollTop = e.scrollHeight;
}


function rawHtml(id) {

    var sec = $('#count-sec');
    var html = 'Auto-updating (15s)';
    // var html = sec.html();

    $.ajax({
        url: 'index.php?r=rigs/raw&id=' + id,
        method: 'post',
        data: {'type': 'json', '_csrf-backend': getCsrf()},
        dataType: 'json',
        cache: false,
        beforeSend: function(){
            sec.html('Updating...');
        },
        error: function(data){
            console.log(id, data);
        },
        success: function(data){
            // if (data.indexOf('curl') >= 0) {
            //     $('#act-reboot').addClass('enable-reboot-mute');
            // } else {
            //     $('#act-reboot').removeClass('enable-reboot-mute');
            // }
            $('#div-raw').html(data);
            setTimeout(function(){
                sec.html(html);
            }, 1500);
            // countSec();
            rawScroll();
        },
    });
}


function getFirstRig() {
    var e = document.getElementById('raw-html');
    return $(e).attr('data-id'); 
}


function rigExpand(data) {


        // console.log(data);

        $('#act-reboot').removeClass('enable-reboot-mute enable-off enable-canceled').addClass('enable-on');

        $('#rig-first .chart-container').html('<div class="pull-left chart-container"> <canvas id="chart-first"></canvas> </div>');

        $('#rig-first .span-hostname').html(data['hostname']);
        $('#rig-first .span-ip').html(data['ip']);

        var s = $('.enable-switch');

        if (data['enabled']) {
            s.removeClass('enable-off').addClass('enable-on');
        } else {
            s.removeClass('enable-on').addClass('enable-off');
        }

        if (data['temps']) {
            html = [];
            for (var i = data['temps'].length - 1; i >= 0; i--) {
                html += '<small class="span-temp ' + (parseInt(data['temps'][i]['temp']) > 60 || !parseInt(data['temps'][i]['temp']) ? 'text-danger' : '') + '">' + data['temps'][i]['temp'] + '/' + data['temps'][i]['fanspeed'] + '</small>' + (i % 4 == 0 ? '<br/>' : '');
            }
            $('#rig-first .div-temp').html(html);
        }


        // STATE Label
        if (data['runtime']) {
            $('.span-runtime').html(data['runtime']);
        } 
        else {
            $('.label-up').html('Runtime: --');
        }


        // STATE Label
        if (data['state']) {
            $('.label-up').html('State: UP').removeClass('label-danger').addClass('label-success');
        } 
        else {
            $('.label-up').html('State: DOWN').removeClass('label-success').addClass('label-danger');
        }

        // COUNT Label
        $('.label-count').html('GPUs: ' + data['count']);
        if (data['count'] < 8) {
            $('.label-count').removeClass('label-success').addClass('label-danger');
        }
        else {
            $('.label-count').removeClass('label-danger').addClass('label-success');
        }

        // HASHRATE Label
        $('.label-rate').html('Rate: ' + data['rate'] + ' MH/s');
        if (data['rate'] < 210) {
            $('.label-rate').removeClass('label-success label-warning').addClass('label-danger');
        } 
        else if (data['rate'] > 210 && data['rate'] < 230) {
            $('.label-rate').removeClass('label-danger label-success').addClass('label-warning');
        }
        else {
            $('.label-rate').removeClass('label-danger label-warning').addClass('label-success');
        }


        rigFirstHashrate(data['dayRate']);

        $('#raw-html').attr('data-id', data['id']);
        $('#div-raw').html('');
        rawHtml(data['id']);
}