<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once 'request.php';

use HTTP\Controllers\AdminController;
use HTTP\Controllers\LoginController;
use HTTP\Controllers\PersonaController;
use HTTP\Router\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$loginController = new LoginController;
$adminController = new AdminController;
$personaController = new PersonaController;
$router = new Router;