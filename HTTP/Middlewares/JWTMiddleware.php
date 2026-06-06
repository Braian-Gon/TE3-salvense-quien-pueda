<?php
namespace HTTP\Middlewares;
# Importa las dependencias necesarias para el manejo de JWT y excepciones relacionadas.
use DomainException; # Expansión de dominio
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
        # Verifica si la cookie de sesión existe. Si no existe, devuelve un error 401
        if(empty($_COOKIE['session_cookie'])){
            request(401, "No se encontró cookies de sesión");
        }
        else {
            # Si la cookie existe, valida el token.
            $this->token = $_COOKIE['session_cookie'];
            $this->decodificarToken();
        }
    }

    public function getTokenData(){
        # Getter para recuperar el token decodificado después de la validación.
        return $this->decodedToken;
    }

    private  function decodificarToken(){
        
        # Intenta decodificar el token y maneja las posibles excepciones que puedan surgir durante el proceso de validación.
        try {
            # Valida y decodifica el token utilizando la clave secreta definida en las variables de entorno.
            # El token decodificado es un objeto.
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
        # Elimina la cookie de sesión estableciendo su valor a vacío y su tiempo de expiración en el pasado.
        setcookie('session_cookie', '', time() - 3600, httponly: true, secure:true);
    }
}