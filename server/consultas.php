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
function filterResultado($con, $tipo_indisponibilidad, $fechainicio, $fechafin)
{
    /* $filter = ['TIPO_INDISPONIBILIDAD' => $tipo_indisponibilidad];
    $query = new MongoDB\Driver\Query($filter);
    $result = $con->executeQuery($GLOBALS['dbname'] . ".log_resultados", $query);
    $respuesta = current($result->toArray());
    return $respuesta; */
    $filter = [
        'FECHA_RESULTADO' => ['$gte' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechainicio)), '$lt' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechafin))],
        'TIPO_INDISPONIBILIDAD' => $tipo_indisponibilidad
    ];
    $Command = new MongoDB\Driver\Command(["count" => "log_resultados", "query" => $filter]);
    $result = $con->executeCommand($GLOBALS['dbname'], $Command);
    $respuesta = current($result->toArray());
    return $respuesta;

}

function filterBusqueda($con, $contexto, $fechainicio, $fechafin)
{
    $filter = [
        'FECHA_BUSQUEDA' => ['$gte' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechainicio)), '$lt' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechafin))],
        'CONTEXTO' => $contexto
    ];
    $Command = new MongoDB\Driver\Command(["count" => "log_busqueda", "query" => $filter]);
    $result = $con->executeCommand($GLOBALS['dbname'], $Command);
    $respuesta = current($result->toArray());
    return $respuesta;
}

function filterCriterioBusqueda($con, $criterio, $fechainicio, $fechafin)
{
    /* $filter = ['CRITERIO' => $criterio];
    $query = new MongoDB\Driver\Query($filter);
    $result = $con->executeQuery($GLOBALS['dbname'] . ".log_busqueda", $query);
    $respuesta = current($result->toArray());
    return $respuesta; */

    $filter = [
        'FECHA_BUSQUEDA' => ['$gte' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechainicio)), '$lt' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechafin))],
        'CRITERIO' => $criterio
    ];
    $Command = new MongoDB\Driver\Command(["count" => "log_busqueda", "query" => $filter]);
    $result = $con->executeCommand($GLOBALS['dbname'], $Command);
    $respuesta = current($result->toArray());
    return $respuesta;

}

function filterUsoWeb($con, $tipo_acceso, $fechainicio, $fechafin)
{
    /* $filter = ['TIPO_ACCESO' => $tipo_acceso];
    $query = new MongoDB\Driver\Query($filter);
    $result = $con->executeQuery($GLOBALS['dbname'] . ".log_accecso_web", $query);
    $respuesta = current($result->toArray());
    return $respuesta; */

    $filter = [
        'FECHA' => ['$gte' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechainicio)), '$lt' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechafin))],
        'TIPO_ACCESO' => $tipo_acceso
    ];
    $Command = new MongoDB\Driver\Command(["count" => "log_acceso_web", "query" => $filter]);
    $result = $con->executeCommand($GLOBALS['dbname'], $Command);
    $respuesta = current($result->toArray());
    return $respuesta;
}

function filterIngresoPorHora($con)
{
    $Command = new MongoDB\Driver\Command([
        'aggregate' => 'log_busqueda',
        'pipeline' => [
            [
                '$project' => [
                    "hora_dia" => [
                        '$hour' => '$FECHA_BUSQUEDA'
                    ]
                ]
            ],
            [
                '$group' => ['_id' => '$hora_dia',
                'sum' => ['$sum' => 1]]
            ],
            [
                '$sort' => ["_id" => 1]
            ]
        ]
    ]);
    $result = $con->executeCommand($GLOBALS['dbname'], $Command);
    $respuesta = current($result->toArray());
    return $respuesta;
}

function filterIngresoPorDia($con)
{
    $Command = new MongoDB\Driver\Command([
        'aggregate' => 'log_busqueda',
        'pipeline' => [
            [
                '$project' => [
                    "dia_semana" => [
                        '$dayOfWeek' => '$FECHA_BUSQUEDA'
                    ]
                ]
            ],
            [
                '$group' => ['_id' => '$dia_semana',
                'sum' => ['$sum' => 1]]
            ],
            [
                '$sort' => ["_id" => 1]
            ]
        ]
    ]);
    $result = $con->executeCommand($GLOBALS['dbname'], $Command);
    $respuesta = current($result->toArray());
    return $respuesta;

}

function filterCalificaciones($con, $calificacion, $fechainicio, $fechafin)
{
    $filter = [
        'FECHA' => ['$gte' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechainicio)), '$lt' => new \MongoDB\BSON\UTCDateTime(new \DateTime($fechafin))],
        'CALIFICACION' => $calificacion
    ];
    $Command = new MongoDB\Driver\Command(["count" => "calificacion", "query" => $filter]);
    $result = $con->executeCommand($GLOBALS['dbname'], $Command);
    $respuesta = current($result->toArray());
    return $respuesta;
}
