<?php

require 'lib.php';

$api = new InfoApi();
$usr = $_POST['user'];
$pwd = $_POST['pwd'];

if (isset($usr, $pwd)) {
    $json = $api->login($usr, $pwd);

    if (sizeof($json) != 0) {
        $api->setLogin($json[0]['idusuario']);
        session_start();
        $_SESSION['idusuario'] = $json[0]['idusuario'];
    }
}

echo json_encode($json);
