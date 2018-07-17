<?php
require 'lib.php';
$api = new ChatbotApi();
$tipo_indisponibilidad = $_POST['tipoIndisponibilidad'];
$fechainicio = $_POST['fechaInicio'];
$fechafin = $_POST['fechaFin'];
$response = $api->getResultado($tipo_indisponibilidad, $fechainicio, $fechafin);
json_encode($response);
