<?php

require 'lib.php';

$api = new ChatbotApi();

$fechainicio = $_POST['fechaInicio'];
$fechafin = $_POST['fechaFin'];

$respuestaJSON = array();

$respuestaJSON['res_busqueda']['c1'] = $api->getBusqueda('c1', $fechainicio, $fechafin);
$respuestaJSON['res_busqueda']['c2'] = $api->getBusqueda('c2', $fechainicio, $fechafin);

$respuestaJSON['res_resultados']['Suspensión Efectiva'] = $api->getResultado('Suspensión Efectiva', $fechainicio, $fechafin);
$respuestaJSON['res_resultados']['Suspensión Programada'] = $api->getResultado('Suspensión Programada', $fechainicio, $fechafin);
$respuestaJSON['res_resultados']['Sin Indisponibilidad Reportada'] = $api->getResultado('Sin Indisponibilidad Reportada', $fechainicio, $fechafin);
$respuestaJSON['res_resultados']['Indisponibilidad a nivel de Circuito'] = $api->getResultado('Indisponibilidad a nivel de Circuito', $fechainicio, $fechafin);
$respuestaJSON['res_resultados']['Indisponibilidad a nivel de Nodo'] = $api->getResultado('Indisponibilidad a nivel de Nodo', $fechainicio, $fechafin);

$respuestaJSON['res_criterioBusqueda']['niu'] = $api->getCriterioBusqueda('niu', $fechainicio, $fechafin);
$respuestaJSON['res_criterioBusqueda']['cedula'] = $api->getCriterioBusqueda('cedula', $fechainicio, $fechafin);
$respuestaJSON['res_criterioBusqueda']['nombre'] = $api->getCriterioBusqueda('nombre', $fechainicio, $fechafin);
$respuestaJSON['res_criterioBusqueda']['direccion'] = $api->getCriterioBusqueda('direccion', $fechainicio, $fechafin);
$respuestaJSON['res_criterioBusqueda']['nit'] = $api->getCriterioBusqueda('nit', $fechainicio, $fechafin);

$respuestaJSON['res_usoViaWeb']['Ingreso'] = $api->getUsoWeb('Ingreso', $fechainicio, $fechafin);
$respuestaJSON['res_usoViaWeb']['Salida'] = $api->getUsoWeb('Salida', $fechainicio, $fechafin);

echo json_encode($respuestaJSON);
