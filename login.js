$(document).ready(function () {
    var check = function () {
        if (usr.hasClass('notok') || psw.hasClass('notok')) {
            btn.prop('disabled', true);
            btn.addClass('notok');
        } else {
            btn.prop('disabled', false);
            btn.removeClass('notok');
        }
    };

    var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    var usr = $("input[name=usr]");
    var psw = $("input[name=psw]");
    var btn = $("input[name=btn]");

    usr.addClass('notok');
    psw.addClass('notok');
    btn.prop('disabled', true);
    btn.addClass('notok');


    usr.on('input', function () {
        if ($(this).val().length > 0 && re.test($(this).val())) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }

        check();
    });
    psw.on('input', function () {
        if ($(this).val().length > 0) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }

        check();
    });

});
