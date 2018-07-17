<?php

function ep_getBusqueda($api, $contexto, $fechainicio, $fechafin){
    $response = $api->getBusqueda($contexto, $fechainicio, $fechafin);
    return $response;
}
