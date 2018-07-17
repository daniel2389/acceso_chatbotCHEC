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



return json_encode($respuestaJSON);