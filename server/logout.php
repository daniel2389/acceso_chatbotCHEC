<?php
require 'lib.php';

session_start();
$api = new InfoApi();
$api->setLogout($_SESSION['idusuario']);

session_destroy();

echo json_encode(true);
