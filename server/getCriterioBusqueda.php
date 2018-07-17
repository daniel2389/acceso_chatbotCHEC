<?php
require 'lib.php';

$api = new ChatbotApi();
$criterio = $_POST['criterio'];
$fechainicio = $_POST['fechaInicio'];
$fechafin = $_POST['fechaFin'];
$response = $api->getCriterioBusqueda($criterio, $fechainicio, $fechafin);
echo json_encode($response);
