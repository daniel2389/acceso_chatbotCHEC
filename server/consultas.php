<?php
$dbname = "heroku_69tb2th4";

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
    $sql = "select idusuario, nombre from usuario_chatbot where email = '$usr' and contrasena = '$pwd'";
    return executeQuery($con, $sql);
}


function insertLogAcceso($con, $usuario, $tipo_acceso)
{
    $bulk = new MongoDB\Driver\BulkWrite;
    $a = $bulk->insert(
        [
            'FECHA' => date("d-m-Y G:i"),
            'USUARIO' => $usuario,
            'TIPO_ACCESO' => $tipo_acceso,
        ]);
    $result = $con->executeBulkWrite($GLOBALS['dbname'] . '.log_acceso_web', $bulk);
    return $result;
}
