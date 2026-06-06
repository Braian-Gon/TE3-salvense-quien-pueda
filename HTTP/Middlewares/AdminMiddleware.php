<?php
namespace HTTP\Middlewares;
use HTTP\Middlewares\JWTMiddleware;

# Hereda de JWTMiddleware para validar el token y luego verificar si el rol es de administrador
class AdminMiddleware extends JWTMiddleware
{
    public function validarAdmin(callable $funcion){
        # Método heredado de JWTMiddleware para validar el token.
        $this->validarToken();
        # Verifica el rol del usuario extraído del token, si no es "Administrador", 
        # se envía una respuesta de error con código 403 (Forbidden) y un mensaje indicando que se requiere el rol de administrador 
        # para acceder a la función protegida.
        if ($this->getTokenData()->rol !== 'Administrador') {
            request(403, "Acceso denegado: se requiere rol de administrador");
            
        }
        call_user_func($funcion);
    }
}