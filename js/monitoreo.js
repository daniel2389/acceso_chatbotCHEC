import {
    initBusquedasGraph
} from './busqueda.js';

import {
    initResultadosGraph
} from './resultado.js';

import {
    initCriterioGraph
} from "./criterio_busqueda.js";

import { initIngresoHora } from "./uso_por_hora.js";

import {initIngresoPorDia} from './uso_por_dia.js';



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
    cargarFijos();

});


/* PLUGIN FILTRO */
$(function () {

    var start = moment().subtract(29, 'days');
    var end = moment();


    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        cargarDatos(start.format('YYYY-MM-DD HH:mm'), end.format('YYYY-MM-DD HH:mm'));
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
    $('.criterioBusqueda').empty();
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
            //llenar cada tabla e iniciar cada graph
            llenarTablas(response)

        }
    });
}

function cargarFijos() {
    $.ajax({
        type: "post",
        url: "server/ingreso_dia.php",
        dataType: "json",
        success: function (response) {
            initIngresoPorDia(response.dia);
            initIngresoHora(response.hora);
        }
    });
}


function llenarTablas(response) {
    // TABLA DE BUSQUEDAS
    $('#cantidad_c1').text(response.res_busqueda.c1.n);
    $('#cantidad_c2').text(response.res_busqueda.c2.n);
    // TABLA DE RESULTADOS
    $('#cantidad_susp_programada').text(response.res_resultados.suspensionProgramada.n);
    $('#cantidad_susp_efectiva').text(response.res_resultados.suspensionEfectiva.n);
    $('#cantidad_circuito').text(response.res_resultados.indisponibilidadNivelCircuito.n);
    $('#cantidad_dano').text(response.res_resultados.indisponibilidadNivelNodo.n);
    $('#cantidad_nada').text(response.res_resultados.sinIndisponibilidadReportada.n);
    // TABLA DE CRITERIO RESULTADO
    $('#cantidad_niu').text(response.res_criterioBusqueda.niu.n);
    $('#cantidad_cc').text(response.res_criterioBusqueda.cedula.n);
    $('#cantidad_nombre').text(response.res_criterioBusqueda.nombre.n);
    $('#cantidad_direccion').text(response.res_criterioBusqueda.direccion.n);
    $('#cantidad_nit').text(response.res_criterioBusqueda.nit.n);
    // TABLA DE ACCESO WEB
    $('#cantidadIngreso').text(response.res_usoViaWeb.Ingreso.n);
    $('#cantidadSalida').text(response.res_usoViaWeb.Salida.n);
    //TABLA CALIFICACIONES
    $('#excelente').text(response.res_calificaciones.excelente.n);
    $('#bueno').text(response.res_calificaciones.bueno.n);
    $('#regular').text(response.res_calificaciones.regular.n);
    $('#malo').text(response.res_calificaciones.malo.n);

    // creacion porcentajes Busquedas
    let porcentajesBusqueda = getPorcentaje([response.res_busqueda.c1.n, response.res_busqueda.c2.n]);
    $('#porcentaje_c1').text(porcentajesBusqueda[0]);
    $('#porcentaje_c2').text(porcentajesBusqueda[1]);
    initBusquedasGraph(response.res_busqueda);
    // creacion porcentajes Resultados
    let porcentajesResultado = getPorcentaje([response.res_resultados.suspensionProgramada.n,
        response.res_resultados.suspensionEfectiva.n, response.res_resultados.indisponibilidadNivelCircuito.n,
        response.res_resultados.indisponibilidadNivelNodo.n, response.res_resultados.sinIndisponibilidadReportada.n
    ]);
    $('#porcentaje_susp_programada').text(porcentajesResultado[0]);
    $('#porcentaje_susp_efectiva').text(porcentajesResultado[1]);
    $('#porcentaje_circuito').text(porcentajesResultado[2]);
    $('#porcentaje_dano').text(porcentajesResultado[3]);
    $('#porcentaje_nada').text(porcentajesResultado[4]);
    initResultadosGraph(response.res_resultados);
    // creacion porcentajes criterio
    let porcentajesCriterio = getPorcentaje([response.res_criterioBusqueda.niu.n, response.res_criterioBusqueda.cedula.n,
        response.res_criterioBusqueda.nombre.n, response.res_criterioBusqueda.direccion.n, response.res_criterioBusqueda.nit.n
    ]);
    $('#porcentaje_niu').text(porcentajesCriterio[0]);
    $('#porcentaje_cc').text(porcentajesCriterio[1]);
    $('#porcentaje_nombre').text(porcentajesCriterio[2]);
    $('#porcentaje_direccion').text(porcentajesCriterio[3]);
    $('#porcentaje_nit').text(porcentajesCriterio[4]);
    initCriterioGraph(response.res_criterioBusqueda);

    






}

function getPorcentaje(arrayEntrada) {

    let suma = 0;

    arrayEntrada.forEach(element => {
        suma += element;
    });

    let arregloRespuesta = [];
    arrayEntrada.forEach(element => {
        arregloRespuesta.push((Math.round(element / suma * 100)) + "%");
    });

    return arregloRespuesta;
}