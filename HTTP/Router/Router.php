<?php

namespace HTTP\Router;

use HTTP\Middlewares\AdminMiddleware;
use HTTP\Middlewares\AllMiddleware;

class Router {

    # Guarda las rutas para cada método HTTP y el middleware asociado a cada ruta para su autenticación
    private  $getRutas;
    private  $postRutas;
    private  $protectedRutas;

    # Constructor que inicializa los middlewares para la autenticación de rutas protegidas, 
    # utilizando la inyección de dependencias para facilitar las pruebas y la flexibilidad del código.
    public function __construct(
    protected AdminMiddleware $adminMiddleware = new AdminMiddleware(),
    protected AllMiddleware $allMiddleware = new AllMiddleware())
    {
    }

    public function get($url, $fn, $middleware = null){
        # Guarda la función asociada a la ruta y el middleware para la autenticación de la ruta para los metodos GET
        $this->getRutas[$url] = $fn; # Guarda la función asociada a la ruta
        $this->protectedRutas[$url] = $middleware; # Guarda el middleware para la autenticación asociada a la ruta
    }

    public function post($url, $fn, $middleware = null){
        # Guarda la función asociada a la ruta y el middleware para la autenticación de la ruta para los metodos POST
        $this->postRutas[$url] = $fn; # Guarda la función asociada a la ruta
        $this->protectedRutas[$url] = $middleware; # Guarda el middleware para la autenticación asociada a la ruta
    }

    public function comprobarRutas(){

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; # Obtiene la ruta actual desde la variable de servidor, o asigna '/' si no se encuentra
        $metodo = $_SERVER['REQUEST_METHOD']; # Obtiene el método HTTP de la solicitud actual

        #Según el método HTTP, busca la función asociada a la ruta actual en el array correspondiente (getRutas o postRutas).
        switch ($metodo){
            case 'GET': 
                $funcion = $this->getRutas[$urlActual] ?? null;
                break;
            case 'POST':
                $funcion = $this->postRutas[$urlActual] ?? null;
                break;
            default:
                # Si el método HTTP no es GET ni POST, devuelve un error 405 (Método no permitido) y termina la solicitud.
                request(405, "Método no permitido");
                exit;
        }
        # Verifica si la ruta actual tiene un middleware de autenticación asociado en el array protectedRutas. 
        # Si es así, llama al middleware para validar la autenticación del usuario antes de ejecutar la función asociada a la ruta.
        if ($funcion && $this->protectedRutas[$urlActual] === 'administrador') {
            $this->adminMiddleware->validarAdmin($funcion);
            exit;
        }
        elseif ($funcion && $this->protectedRutas[$urlActual] === 'all') {
            $this->allMiddleware->validarAll($funcion);
            exit;
        }
        # Si no hay un middleware de autenticación asociado a la ruta, simplemente ejecuta la función asociada a la ruta.
        elseif($funcion){
            call_user_func($funcion);

        }else {
            request(404, "Página no encontrada");
            exit;
        }
    }

}