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
        $this->connectDBpostgres();
        $this->connectDBmongo();
    }

    public function connectDBpostgres()
    {
        //DB DATA
        $database = "d7jmsqb0pb9n11";
        $uid = "ymuglgckigeyxm";
        $pwd = "8a86f637e663ed9f778e1ec74e3da85d6f6aec7ce57dbbd2cf3c5c82afa3380a";
        $host = "ec2-184-73-201-79.compute-1.amazonaws.com";

        //establecer la conexión
        $this->conPostgres = new PDO("pgsql:host=$host;port=5432;dbname=$database;user=$uid;password=$pwd");
        if (!$this->conPostgres) {
            die('error de conexión');
        }
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
        return logQuery($this->conPostgres, $usr, $pwd);
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
