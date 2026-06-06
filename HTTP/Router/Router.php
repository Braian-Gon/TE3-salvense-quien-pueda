<?php

namespace HTTP\Router;

use HTTP\Middlewares\AdminMiddleware;
use HTTP\Middlewares\AllMiddleware;

class Router {


    private  $getRutas;
    private  $postRutas;
    private  $protectedRutas;

    public function __construct(protected AdminMiddleware $adminMiddleware = new AdminMiddleware(),
    protected AllMiddleware $allMiddleware = new AllMiddleware())
    {
    }

    public function get($url, $fn, $middleware = null){
        $this->getRutas[$url] = $fn;
        $this->protectedRutas[$url] = $middleware;
    }

    public function post($url, $fn, $middleware = null){
        $this->postRutas[$url] = $fn;
        $this->protectedRutas[$url] = $middleware;
    }

    public function comprobarRutas(){

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo){
            case 'GET': 
                $funcion = $this->getRutas[$urlActual] ?? null;
                break;
            case 'POST':
                $funcion = $this->postRutas[$urlActual] ?? null;
                break;
            default:
                request(405, "Método no permitido");
                exit;
        }

        if ($funcion && $this->protectedRutas[$urlActual] === 'administrador') {
            $this->adminMiddleware->validarAdmin($funcion);
            exit;
        }
        elseif ($funcion && $this->protectedRutas[$urlActual] === 'all') {
            $this->allMiddleware->validarAll($funcion);
            exit;
        }
        elseif($funcion){
            call_user_func($funcion);

        }else {
            echo "Ruta no válida";
        }
    }

}