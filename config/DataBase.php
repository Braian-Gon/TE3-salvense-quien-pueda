<?php
class DataBase {
    //Para controlar la instancia existente
    private static $instance = null;
    //Para crear la conexion correspondiente
    private $connection;
    private function __construct() {
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
            //Me permite recibir respuestas como objeto(POO)
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
    //Implementacion de Singleton
    public static function getInstance() 
    {
        //Todo lo estatico no puedo ser instanciado, entonces $this no puede ser usado por ausencia de objeto, en su lugar se usa self que representa esta clase
        //El condicional en PHP cuando se le pasa una variable retorna verdadero cuando hay dato y falso cuando no
        if (!self::$instance) //No esta asignado
        {
            self::$instance = new DataBase();
        }
        return self::$instance->connection;
    }
}