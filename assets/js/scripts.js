console.log('                    ');
console.log(" /                  \ ");
console.log("/  KEYSTROKE BOLADÃO \ ");
console.log('\       2 0 1 6      /');
console.log(' \        UFS       / ');
console.log('  \                / ');

function showQuartis() {
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var jsonData = $.ajax({
            url: "statistic/Quartis.php",
            dataType: "json",
            async: false
        }).responseText;
        var json = eval("(" + jsonData + ")");
        var data = new google.visualization.DataTable(json.dados);
        var chart = new google.visualization.CandlestickChart(document.getElementById('quartis'));
        chart.draw(data, json.config);
    }
}

function showPie() {
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var jsonData = $.ajax({
            url: "statistic/Pie.php",
            dataType: "json",
            async: false
        }).responseText;
        var json = eval("(" + jsonData + ")");
        var data = new google.visualization.DataTable(json.dados);
        var chart = new google.visualization.PieChart(document.getElementById('pie'));
        chart.draw(data, json.config);
    }
}

var dados = [];
var erros = 0;
var arrayTemp = new Array();
var index = 0;
var count = 0;

$('.login-form').on('submit', function(e) {

    e.preventDefault();
    $(".btn-login").prop("disabled", true);

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
                    erros++;
                    $(".btn-login").prop("disabled", false);
                    return false;
                } else if (data == '201') {

                    $.ajax({
                        url: "login/Session.php",
                        data: { dados: dados, errors: erros },
                        type: 'POST',
                        success: function(data) {
                            alert("Bem-vindo :)");
                            window.location = "painel.php";
                        },
                        error: function(data) {
                            alert(data);
                            $(".btn-login").prop("disabled", false);
                            return false;
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
                    $(".btn-login").prop("disabled", false);
                    return false;
                }
            },
            error: function(data) {
                alert(data);
                $(".btn-login").prop("disabled", false);
                return false;
            }
        });
    }
});

$('.registration-form').on('submit', function(e) {

    e.preventDefault();
    $(".btn-login").prop("disabled", true);

    var formData = $(this).serialize();

    $.ajax({
        url: "login/Register.php",
        data: formData,
        type: 'POST',
        success: function(data) {
            if (data == "400") {
                toastr.error('Opa, usuário já cadastradx!');
            } else {
                toastr.success("Faça login para continuar.", "Registradx com sucesso!");
            }
            $(".btn-register").prop("disabled", false);
        },
        error: function(data) {
            toastr.error('Ocorreu um erro.');
            $(".btn-register").prop("disabled", false);
            return false;
        }
    });
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

function registerKeySimulator(event) {
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

function comparar() {
    adjustTime()
    equalizeTime()
    r = 0
    if (t1.length > t2.length) {
        for (x in t2) { r += Math.pow((t2[x] - t1[x]), 2) }
        r = Math.sqrt(r) / t2.length
    } else {
        for (x in t1) {
            r += Math.pow((t2[x] - t1[x]), 2)
        }
        r = Math.sqrt(r) / t1.length
    }
    mostra(r)
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