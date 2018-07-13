$(document).ready(function () {
    validarSesion();
    $('.sidenav').sidenav();
    $('#logoutButton').click(function () {
        logout()
    });
});

/* PLUGIN FILTRO */
$(function () {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "a",
            "customRangeLabel": "Personalizado",
            "weekLabel": "S",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
    }, cb);

    cb(start, end);

});


function validarSesion() {
    var data = {
        idusuario: localStorage.getItem('idusuario')
    }
    $.ajax({
        type: "post",
        url: "server/validateSession.php",
        data: data,
        dataType: "json",
        success: function (response) {
            if (!response) {
                swal(
                    '¡Ay!',
                    'Debes iniciar sesión primero',
                    'error'
                ).then(() => {
                    window.location.href = "login.html"
                })
            }
        }
    });
}


function logout() {

    $.ajax({
        type: "post",
        url: "server/logout.php",
        dataType: "json",
        success: function (response) {
            swal(
                '¡Enhorabuena!',
                'Haz cerrado sesión',
                'success'
            ).then(() => {
                window.location.href = "login.html"
            })
        }
    });
}




function cargarBusqueda() {


    $.ajax({
        type: "get",
        url: "server/getBusqueda.php",
        data: "data",
        dataType: "json",
        success: function (response) {

        }
    });
}

function cargarResultado() {


    $.ajax({
        type: "get",
        url: "server/getResultado.php",
        data: "data",
        dataType: "json",
        success: function (response) {

        }
    });
}

function cargarCriterioBusqueda() {


    $.ajax({
        type: "get",
        url: "server/getCriterioBusqueda.php",
        data: "data",
        dataType: "json",
        success: function (response) {

        }
    });
}

function cargarUsoWeb() {


    $.ajax({
        type: "get",
        url: "server/getUsoWeb.php",
        data: "data",
        dataType: "json",
        success: function (response) {

        }
    });
}

function cargarIngresoPorHora(){


    $.ajax({
        type: "get",
        url: "server/",
        data: "data",
        dataType: "dataType",
        success: function (response) {
            
        }
    });
}
function cargarIngresoPorDia(){
    
}