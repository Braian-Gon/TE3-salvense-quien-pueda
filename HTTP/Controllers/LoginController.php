<?php

namespace HTTP\Controllers;

use DataBase;
use PDO;

class LoginController
{
    public function mostrarLogin()
    {
        include __DIR__ . '/../views/login.php'; 
    }
    public function veradmin()
    {
        $db = DataBase::getInstance();
        $sql = "SELECT * FROM Administrador where id_administrador = 1;";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        echo json_encode($resultado);
    }
}
