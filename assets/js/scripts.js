var dados = [];

var arrayTemp = new Array();
var index = 0;
var count = 0;

$('.login-form').on('submit', function(e) {
    if (count < 15) {
        adjustTime();
        equalizeTime();

        dados[count] = arrayTemp;

        arrayTemp = new Array();
        index = 0;

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: 'login/Login.php',
            data: formData,
            success: function(data) {
                if (data == "404") {
                    toastr.error("Dados incorretos!");
                    $('#form-username').val('');
                    $('#form-password').val('');
                    $("#form-username").focus();
                } else if (data == '201') {

                    $.ajax({
                        url: "login/Session.php",
                        data: { dados: dados },
                        type: 'POST',
                        success: function() {
                            window.location = "painel.php";
                        },
                        error: function(data) {
                            alert(data);
                        }
                    });

                } else if (data == '200') {
                    window.location = "painel.php";
                } else {
                    $('#attempt').val(data);
                    count++;
                    $('#form-username').val('');
                    $('#form-password').val('');
                    $("#form-username").focus();

                    toastr.info('Faltam ' + (15 - count) + ' tentativas.');
                }
            },
            error: function(data) {
                document.getElementById("resultdb").innerHTML = data;
                return false;
            }
        });
    }
    e.preventDefault();
});

function registerKey(event) {
    if (event.keyCode == 46 || event.keyCode == 8) {
        $('#form-password').val('');
        arrayTemp = new Array();
        index = 0;
    } else if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 96 && event.keyCode <= 105)) {
        if (arrayTemp.length < 5) {
            d = new Date()
            arrayTemp[index] = d.getMinutes() * 60 + d.getSeconds() + d.getMilliseconds() / 1000
            index++
        }
    }
}

function adjustTime() {
    for (i = arrayTemp.length - 1; i > 0; i--) { arrayTemp[i] -= arrayTemp[i - 1] }
    arrayTemp[0] = 0;
}

function equalizeTime(t) {
    for (x in arrayTemp) { arrayTemp[x] = Math.pow((1 + Math.exp(-1.7 * (Math.log(arrayTemp[x]) + 1.56) / 0.65)), -1) }
}


jQuery(document).ready(function() {
    /*
        Login form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
        $(this).removeClass('input-error');
    });

    $('.login-form').on('submit', function(e) {

        $(this).find('input[type="text"], input[type="password"], textarea').each(function() {
            if ($(this).val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });

    });
    /*
        Registration form validation
    */
    $('.registration-form input[type="text"], .registration-form textarea').on('focus', function() {
        $(this).removeClass('input-error');
    });

    $('.registration-form').on('submit', function(e) {

        $(this).find('input[type="text"], input[type="password"], textarea').each(function() {
            if ($(this).val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });

    });
});