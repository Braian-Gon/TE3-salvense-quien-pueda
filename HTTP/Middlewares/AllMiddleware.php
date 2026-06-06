<?php

namespace HTTP\Middlewares;
use HTTP\Middlewares\JWTMiddleware;

# Hereda de JWTMiddleware para validar el token antes de ejecutar la función pasada como parámetro

Class AllMiddleware extends JWTMiddleware
{
    # Método heredado de JWTMiddleware para validar el token.
    public function validarAll(callable $funcion){
        $this->validarToken();
        # Llama a la función pasada como parámetro, pasando el ID del usuario extraído del token como argumento.
        # Utiliza call_user_func_array para llamar a la función con el ID del usuario como argumento, 
        # lo que permite que la función protegida reciba el ID del usuario autenticado para realizar operaciones específicas según el usuario.
        call_user_func_array($funcion, [$this->getTokenData()->id]);
    }
}