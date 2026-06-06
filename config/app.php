<?php
# Carga el autoload de Composer para resolver los namespaces
require_once __DIR__ . '/../vendor/autoload.php';
# Carga la funcion request para toda la aplicación
require_once 'request.php';
# Carga los controladores y el router para toda la aplicación
use HTTP\Controllers\AdminController;
use HTTP\Controllers\LoginController;
use HTTP\Controllers\PersonaController;
use HTTP\Router\Router;

# Carga las variables de entorno desde el archivo .env con dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
# Instancia los controladores y el router para toda la aplicación

$loginController = new LoginController;
$adminController = new AdminController;
$personaController = new PersonaController;
$router = new Router;