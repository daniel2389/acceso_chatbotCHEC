<?php

require 'lib.php';

$api = new ChatbotApi();

$fechainicio = $_POST['fechaInicio'];
$fechafin = $_POST['fechaFin'];

$respuestaJSON = array();

$respuestaJSON['res_busqueda']['c1'] = $api->getBusqueda('c1', $fechainicio, $fechafin);
$respuestaJSON['res_busqueda']['c2'] = $api->getBusqueda('c2', $fechainicio, $fechafin);

$respuestaJSON['res_resultados']['suspensionProgramada'] = $api->getResultado('Suspensión Programada', $fechainicio, $fechafin);
$respuestaJSON['res_resultados']['suspensionEfectiva'] = $api->getResultado('Suspensión Efectiva', $fechainicio, $fechafin);
$respuestaJSON['res_resultados']['indisponibilidadNivelCircuito'] = $api->getResultado('Indisponibilidad a nivel de Circuito', $fechainicio, $fechafin);
$respuestaJSON['res_resultados']['indisponibilidadNivelNodo'] = $api->getResultado('Indisponibilidad a nivel de Nodo', $fechainicio, $fechafin);
$respuestaJSON['res_resultados']['sinIndisponibilidadReportada'] = $api->getResultado('Sin Indisponibilidad Reportada', $fechainicio, $fechafin);

$respuestaJSON['res_criterioBusqueda']['niu'] = $api->getCriterioBusqueda('niu', $fechainicio, $fechafin);
$respuestaJSON['res_criterioBusqueda']['cedula'] = $api->getCriterioBusqueda('cedula', $fechainicio, $fechafin);
$respuestaJSON['res_criterioBusqueda']['nombre'] = $api->getCriterioBusqueda('nombre', $fechainicio, $fechafin);
$respuestaJSON['res_criterioBusqueda']['direccion'] = $api->getCriterioBusqueda('direccion', $fechainicio, $fechafin);
$respuestaJSON['res_criterioBusqueda']['nit'] = $api->getCriterioBusqueda('nit', $fechainicio, $fechafin);

$respuestaJSON['res_usoViaWeb']['Ingreso'] = $api->getUsoWeb('Ingreso', $fechainicio, $fechafin);
$respuestaJSON['res_usoViaWeb']['Salida'] = $api->getUsoWeb('Salida', $fechainicio, $fechafin);

$respuestaJSON['res_calificaciones']['excelente'] = $api->getCalificaciones('Excelente', $fechainicio, $fechafin);
$respuestaJSON['res_calificaciones']['bueno'] = $api->getCalificaciones('Bueno', $fechainicio, $fechafin);
$respuestaJSON['res_calificaciones']['regular'] = $api->getCalificaciones('Regular', $fechainicio, $fechafin);
$respuestaJSON['res_calificaciones']['malo'] = $api->getCalificaciones('Malo', $fechainicio, $fechafin);

echo json_encode($respuestaJSON);
