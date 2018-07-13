<?php
require 'lib.php';
$api = new ChatbotApi();
$contexto = $_POST['contexto'];
$fechainicio = $_POST['fechaInicio'];
$fechafin = $_POST['fechaFin'];
$response = $api->getBusqueda($contexto, $fechainicio, $fechafin);
echo json_encode($response);
