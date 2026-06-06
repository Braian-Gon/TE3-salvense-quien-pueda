<?php

namespace HTTP\Middlewares;
use HTTP\Middlewares\JWTMiddleware;

Class AllMiddleware extends JWTMiddleware
{
    public function validarAll(callable $funcion){
        $this->validarToken();
        call_user_func_array($funcion, [$this->getTokenData()->id]);
    }
}