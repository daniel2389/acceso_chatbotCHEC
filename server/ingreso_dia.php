<?php

require 'lib.php';

$api = new ChatbotApi();

$resultado['dia'] = $api->getIngresoPorDia();
$resultado['hora'] = $api->getIngresoPorHora();

echo json_encode($resultado);