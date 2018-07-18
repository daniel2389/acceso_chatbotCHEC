<?php

require 'lib.php';

$api = new ChatbotApi();

$resultado = $api->getIngresoPorDia();

echo json_encode($resultado);