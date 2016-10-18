$(document).ready(function () {
//  checkdelete call iteself after 1000ms

    var checkDelete = function () {
        var time = new Date();
        var h = time.getHours();
        var m = time.getMinutes();
        var s = time.getSeconds();
        var timeSec = h * 3600 + m * 60 + s;


        deleteBtn.each(function () {
            var $row = $(this).parent().parent().parent();
            var start = $row.find('td:nth-child(1)').text();
            start = start.split(':');

            if (start.length == 3) {
                var startH = parseInt(start[0], 10);
                var startM = parseInt(start[1], 10);
                var startS = parseInt(start[2], 10);
                var startSec = startH * 3600 + startM * 60 + startS;
                if (timeSec > (startSec + 60)) {
                    $(this).prop('disabled', false);
                    $(this).removeClass('notok');
                } else {
                    $(this).prop('disabled', true);
                    $(this).addClass('notok');
                }
            }
        });
        setTimeout(checkDelete, 1000);
    };

    var checkSubmit = function () {
        if (rHour.hasClass('notok') || rDuration.hasClass('notok')) {
            rBtn.prop('disabled', true);
            rBtn.addClass('notok');
        } else {
            console.log("hour ok");
            //hour is correct
            var t = rHour.val().split(':');
            var h = Number(t[0]);
            var m = Number(t[1]);
            var d = Number(rDuration.val());

            if (h * 60 + m + d <= 24 * 60) {
                rBtn.removeClass('notok');
                rBtn.prop('disabled', false);
            } else {
                rBtn.addClass('notok');
                rBtn.prop('disabled', true);
            }

        }
    };

    var regHour = /^([01]?[0-9]|2[0-3]):[0-5]?[0-9]$/;
    var regDuration = /^([1-9][0-9]*)$/;

    var rHour = $("input[name=start]");
    var rDuration = $("input[name=duration]");
    var rBtn = $("input[name=submitReservation]");
    var deleteBtn = $("input[name=deleteBTN]");

    rHour.addClass('notok');
    rDuration.addClass('notok');
    rBtn.prop('disabled', true);
    rBtn.addClass('notok');


    rHour.on('input', function () {
        if ($(this).val().length > 0 && regHour.test($(this).val())) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }

        checkSubmit();
    });
    rDuration.on('input', function () {
        if ($(this).val().length > 0 && regDuration.test($(this).val())) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }
        checkSubmit();
    });


    if (deleteBtn.length > 0) {
        checkDelete();
    }

});

