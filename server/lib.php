<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'consultas.php';

class ChatbotApi
{
    private $conPostgres;
    private $conMongo;
    private $host = "mongodb://heroku_69tb2th4:m2oheamen7422pmnq3htdb56dt@ds113775.mlab.com:13775/heroku_69tb2th4";

    public function __construct()
    {
        $this->connectDBmongo();
    }



    public function connectDBmongo()
    {
        try {
            $this->conMongo = new MongoDB\Driver\Manager($this->host);
        } catch (MongoDB\Driver\Exception\Exception $e) {
            $filename = basename(__FILE__);
            echo "The $filename script has experienced an error.\n";
            echo "It failed with the following exception:\n";
            echo "Exception:", $e->getMessage(), "\n";
            echo "In file:", $e->getFile(), "\n";
            echo "On line:", $e->getLine(), "\n";
        }
    }

    public function login($usr, $pwd)
    {
        return logQuery($this->conMongo, $usr, $pwd);
    }

    //----------------------------INSERTS DE LOG PARA MONITOREO------------------------------------
    public function setLogin($usuario)
    {
        return insertLogAcceso($this->conMongo, $usuario, 'Ingreso');
    }

    public function setLogout($usuario)
    {
        return insertLogAcceso($this->conMongo, $usuario, 'Salida');
    }

    //------------------------- FILTER PARA EL MONITOREO ------------------------------------------

    public function getResultado($tipo_indisponibilidad, $fechainicio, $fechafin)
    {
        return filterResultado($this->conMongo, $tipo_indisponibilidad, $fechainicio, $fechafin);

    }
    public function getBusqueda($contexto, $fechainicio, $fechafin)
    {
        return filterBusqueda($this->conMongo, $contexto, $fechainicio, $fechafin);
    }

    public function getCriterioBusqueda($criterio, $fechainicio, $fechafin)
    {
        return filterCriterioBusqueda($this->conMongo, $criterio, $fechainicio, $fechafin);
    }

    public function getUsoWeb($tipo_acceso, $fechainicio, $fechafin)
    {
        return filterUsoWeb($this->conMongo, $tipo_acceso, $fechainicio, $fechafin);
    }

    public function getIngresoPorHora()
    {
        return filterIngresoPorHora($this->conMongo);
    }

    public function getIngresoPorDia()
    {
        return filterIngresoPorDia($this->conMongo);
    }
    public function getCalificaciones($calificacion, $fechainicio, $fechafin)
    {
        return filterCalificaciones($this->conMongo, $calificacion, $fechainicio, $fechafin);
    }
}
