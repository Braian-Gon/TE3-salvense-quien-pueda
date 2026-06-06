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
        $data = json_decode(file_get_contents('php://input'), true);
        $persona = new Persona($data);
        $persona->savePersona();
    }
    public function update(){
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