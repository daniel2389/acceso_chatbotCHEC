<?php
require 'lib.php';
$api = new ChatbotApi();
$tipo_acceso = $_POST['tipoAcceso'];
$fechainicio = $_POST['fechaInicio'];
$fechafin = $_POST['fechaFin'];
$response = $api->getUsoWeb($tipo_acceso, $fechainicio, $fechafin);
json_encode($response);
