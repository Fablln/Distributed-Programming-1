$(document).ready(function () {
    var check = function () {
        if (user.hasClass('notok') ||
            first.hasClass('notok') ||
            last.hasClass('notok') ||
            psw.hasClass('notok') ||
            cpsw.hasClass('notok')) {

            btn.prop('disabled', true);
            btn.addClass('notok');
        } else {
            btn.prop('disabled', false);
            btn.removeClass('notok');
        }
    };

    var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    var user = $("input[name=user]");
    var first = $("input[name=first]");
    var last = $("input[name=last]");
    var psw = $("input[name=psw]");
    var cpsw = $("input[name=cpsw]");
    var btn = $("input[name=tryReg]");

    user.addClass('notok');
    first.addClass('notok');
    last.addClass('notok');
    psw.addClass('notok');
    cpsw.addClass('notok');
    btn.prop('disabled', true);
    btn.addClass('notok');


    user.on('input', function () {
        if ($(this).val().length > 0 && $(this).val().length <= 32 && re.test($(this).val())) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }

        check();
    });

    first.on('input', function () {
        if ($(this).val().length > 0 && $(this).val().length <= 32) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }

        check();
    });
    last.on('input', function () {
        if ($(this).val().length > 0 && $(this).val().length <= 32) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }

        check();
    });

    psw.on('input', function () {
        if ($(this).val().length > 0 && $(this).val().length <= 32) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }

        check();
    });
    cpsw.on('input', function () {
        if ($(this).val().length > 0 && $(this).val().length <= 32 && ($(this).val() == psw.val())) {
            $(this).removeClass('notok');
        } else {
            $(this).addClass('notok');
        }
        check();
    });

});
