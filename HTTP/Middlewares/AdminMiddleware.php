<?php
namespace HTTP\Middlewares;
use HTTP\Middlewares\JWTMiddleware;

class AdminMiddleware extends JWTMiddleware
{
    public function validarAdmin($funcion){
        $this->validarToken();
        if ($this->getTokenData()->rol !== 'Administrador') {
            request(403, "Acceso denegado: se requiere rol de administrador");
            
        }
        call_user_func($funcion);
        
    }

    
}