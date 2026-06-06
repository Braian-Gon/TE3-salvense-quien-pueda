<?php
namespace HTTP\Controllers;
use HTTP\Models\Persona;

Class PersonaController
{
    public function updatePasswd(int $id){
        $data = json_decode(file_get_contents('php://input'), true);
        if(!isset($data['passwd']) || empty($data['passwd'])){
            request(400, 'La contraseña no puede estar vacía');
        }
        else{
        $data['id'] = $id;
        $persona = new Persona($data);
        $persona->updatePasswd();
        }
    }
}