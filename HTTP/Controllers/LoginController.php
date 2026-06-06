<?php

namespace HTTP\Controllers;
use HTTP\Models\Persona;

class LoginController
{
   /* Visat de prueba <<ignorar>>
    public function mostrarLogin()
    {
        include __DIR__ . '/../views/login.php'; 
    }*/

    public function login(){
        # php://input es un flujo de datos que permite leer el cuerpo de la solicitud HTTP, 
        # necesario para solicitudes POST cuando los datos se envían en formato JSON.
        # json_decode convierte la cadena JSON en un array asociativo de PHP o un objeto, lo que facilita el acceso a los datos enviados por el cliente.
        # Se utiliza el argumento true para que el resultado sea un array asociativo en lugar de un objeto.
        $data = json_decode(file_get_contents('php://input'), true);
        $autenticar = new Persona($data);
        $autenticar->login();
    }
}
