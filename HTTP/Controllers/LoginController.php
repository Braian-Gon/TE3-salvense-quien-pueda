<?php

namespace HTTP\Controllers;
use HTTP\Models\Persona;

class LoginController
{
    public function mostrarLogin()
    {
        include __DIR__ . '/../views/login.php'; 
    }
    public function login(){
        $datos = file_get_contents('php://input');
        $data = json_decode($datos, true);
        $autenticar = new Persona($data);
        $autenticar->login();
    }
}
