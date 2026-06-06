<?php
namespace HTTP\Middlewares;

use DomainException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use InvalidArgumentException;
use UnexpectedValueException;

Class JWTMiddleware
{
    private $token;
    private $decodedToken;

    public function validarToken(){
        if(empty($_COOKIE['session_cookie'])){
            request(401, "No se encontró cookies de sesión");
            exit;
        }
        else {
            $this->token = $_COOKIE['session_cookie'];
            $this->decodificarToken();
        }
    }

    public function getTokenData(){
        return $this->decodedToken;
    }

    private  function decodificarToken(){
        
        try {
        $this->decodedToken = JWT::decode($this->token, new Key($_ENV['JWT_SECRET'], 'HS256'));
        } catch (InvalidArgumentException) {
            JWTMiddleware::cerrarsesion();
            request(401, "Token inválido");
            exit;
        } catch (DomainException) {
            JWTMiddleware::cerrarsesion();
            request(401, "Token inválido");
            exit;
        } catch (SignatureInvalidException) {
            JWTMiddleware::cerrarsesion();
            request(401, "Token inválido");
            exit;
        } catch (BeforeValidException) {
            JWTMiddleware::cerrarsesion();
            request(401, "Token no válido aún");
            exit;
        } catch (ExpiredException) {
            JWTMiddleware::cerrarsesion();
            request(401, "Token expirado");
            exit;
        } catch (UnexpectedValueException) {
            JWTMiddleware::cerrarsesion();
            request(401, "Token inválido");
            exit;
        }
    }
    public static function cerrarsesion(){
        setcookie('session_cookie', '', time() - 3600, httponly: true);
    }
}