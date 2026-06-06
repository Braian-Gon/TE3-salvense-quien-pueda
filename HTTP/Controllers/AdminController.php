<?php
namespace HTTP\Controllers;

use HTTP\Models\Persona;

Class AdminController
{
    public function getPersonas(){
        $persona = new Persona();
        $persona->getPersonas();
    }
    public function register(){
        # php://input es un flujo de datos que permite leer el cuerpo de la solicitud HTTP, 
        # necesario para solicitudes POST cuando los datos se envían en formato JSON.
        # json_decode convierte la cadena JSON en un array asociativo de PHP o un objeto, lo que facilita el acceso a los datos enviados por el cliente.
        # Se utiliza el argumento true para que el resultado sea un array asociativo en lugar de un objeto.
        $data = json_decode(file_get_contents('php://input'), true);
        $persona = new Persona($data);
        $persona->savePersona();
    }
    public function update(){
        # Recupera el ID de la persona a actualizar desde los parámetros de la URL utilizando $_GET. 
        $id = $_GET['id'] ?? null;
        if (!$id) {
            request(400, 'ID de persona no proporcionado');
        }
        else {
            $data = json_decode(file_get_contents('php://input'), true);
            $data['id'] = $id;
            $persona = new Persona($data);
            $persona->savePersona();
        }
    }
    public function delete(){
        # Recupera el ID de la persona a actualizar desde los parámetros de la URL utilizando $_GET. 
        $id = $_GET['id'] ?? null;
        if (!$id) {
            request(400, 'ID de persona no proporcionado');
        }
        else {
            $persona = new Persona(['id' => $id]);
            $persona->savePersona();
        }
    }
}