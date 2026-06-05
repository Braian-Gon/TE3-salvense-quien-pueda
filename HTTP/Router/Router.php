<?php

namespace HTTP\Router;

class Router {


    private static $getRutas;
    private static $postRutas;
    private static $putRutas;

    public static function get($url, $fn){
        self::$getRutas[$url] = $fn;
    }

    public static function post($url, $fn){
        self::$postRutas[$url] = $fn;
    }
    public static function put($url, $fn){
        self::$putRutas[$url] = $fn;
    }

    public static function comprobarRutas(){

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch ($metodo){
            case 'GET': 
                $funcion = self::$getRutas[$urlActual] ?? null;
                break;
            case 'POST':
                $funcion = self::$postRutas[$urlActual] ?? null;
                break;
            case 'PUT':
                $funcion = self::$putRutas[$urlActual] ?? null;
        }

        if($funcion){
            call_user_func($funcion);

        }else {
            echo "Ruta no válida";
        }
    }

}