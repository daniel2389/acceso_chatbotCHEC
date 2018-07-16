<?php
$dbname = "heroku_69tb2th4";
date_default_timezone_set('America/Bogota');
function executeQuery($con, $sql)
{
    $result = $con->query($sql);
    if ($result) {
        $fetched_data = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            array_push($fetched_data, $row);
        }
        return $fetched_data;
    } else {
        return $con->errorInfo()[2];
    }
}

function logQuery($con, $usr, $pwd)
{
    $sql = "select idusuario, nombre, tipo_usuario from usuario_chatbot where email = '$usr' and contrasena = '$pwd'";
    return executeQuery($con, $sql);
}

function insertLogAcceso($con, $usuario, $tipo_acceso)

{
    $bulk = new MongoDB\Driver\BulkWrite;
    $a = $bulk->insert(
        [
            'FECHA' => new \MongoDB\BSON\UTCDateTime(new \DateTime()),
            'USUARIO' => $usuario,
            'TIPO_ACCESO' => $tipo_acceso,
        ]);
    $result = $con->executeBulkWrite($GLOBALS['dbname'] . '.log_acceso_web', $bulk);
    return $result;
}

//-------------------------------------- OBTENER VALORES PARA EL MONITOREO ------------------------------
function filterResultado($con, $tipo_indisponibilidad)
{
    $filter = ['TIPO_INDISPONIBILIDAD' => $tipo_indisponibilidad];
    $query = new MongoDB\Driver\Query($filter);
    $result = $con->executeQuery($GLOBALS['dbname'] . ".log_resultados", $query);
    $respuesta = current($result->toArray());
    return $respuesta;
}

function filterBusqueda($con, $contexto, $fechainicio, $fechafin)
{
    $filter = ['CONTEXTO' => $contexto];
    $Command = new MongoDB\Driver\Command(["count" => "log_busqueda", "query" => ['CONTEXTO' => $contexto]]);
    $Result = $con->executeCommand($GLOBALS['dbname'], $Command);
    $respuesta = current($result->toArray());
    return $respuesta;
}

function filterCriterioBusqueda($con, $criterio)
{
    $filter = ['CRITERIO' => $criterio];
    $query = new MongoDB\Driver\Query($filter);
    $result = $con->executeQuery($GLOBALS['dbname'] . ".log_busqueda", $query);
    $respuesta = current($result->toArray());
    return $respuesta;
}

function filterUsoWeb($con, $tipo_acceso)
{
    $filter = ['TIPO_ACCESO' => $tipo_acceso];
    $query = new MongoDB\Driver\Query($filter);
    $result = $con->executeQuery($GLOBALS['dbname'] . ".log_accecso_web", $query);
    $respuesta = current($result->toArray());
    return $respuesta;
}

function filterIngresoPorHora($con)
{

}

function filterIngresoPorDia($con)
{

}
