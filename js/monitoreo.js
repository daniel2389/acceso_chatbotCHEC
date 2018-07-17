$(document).ready(function () {
    validarSesion();
    $('.tooltipped').tooltip();
    $('.sidenav').sidenav();
    $('#logoutButton').click(function () {
        logout()
    });
    $('#logoutLateral').click(function () {
        logout()
    });

});


/* PLUGIN FILTRO */
$(function () {

    var start = moment().subtract(29, 'days');
    var end = moment();


    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        cargarDatos(start._d.toString(), end._d.toString());
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


function cargarDatos(fechainicio, fechafin) {
    var data = {
        fechaInicio: fechainicio,
        fechaFin: fechafin
    }

    $.ajax({
        type: "post",
        url: "server/graph.php",
        data: data,
        dataType: "json",
        success: function (response) {
            console.log(response);
            //llenar cada tabla e iniciar cada graph
            llenarTablas(response)

        }
    });
}


function llenarTablas(response){
    $('#cantidad_c1').text(response.res_busqueda.c1.n);
    $('#cantidad_c2').text(response.res_busqueda.c2.n);
    let porcentajesBusqueda = getPorcentaje([response.res_busqueda.c1.n, response.res_busqueda.c2.n]);
    $('#porcentaje_c1').text(porcentajesBusqueda[0]);
    $('#porcentaje_c2').text(porcentajesBusqueda[1]);
}

function getPorcentaje(arrayEntrada){

    let suma = 0;
    
    arrayEntrada.forEach(element => {
        suma += element;
    });

    let arregloRespuesta = [];
    arrayEntrada.forEach(element => {
        arregloRespuesta.push((Math.round(element/suma*100))+"%");
    });

    return arregloRespuesta;
}


