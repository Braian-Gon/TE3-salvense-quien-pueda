<?php
namespace Config;

use PDO;
use PDOException;

class DataBase {
    //Para crear la conexion correspondiente
    public $connection;
    public function __construct() {
        # Obtiene los datos de conexión desde las variables de entorno cargadas por dotenv
        $serverName = $_ENV['DB_HOST']; 
        $database = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];
        try 
        {
            //data source name
            $dsn = "sqlsrv:Server=$serverName;Database=$database;Encrypt=true;TrustServerCertificate=true";
            //Construir el objeto de conexion
            $this->connection = new PDO($dsn, $username, $password);
            //Habilita la respuesta de la BD como excepciones PHP en caso de fallar
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Me permite recibir respuestas como objetos
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}