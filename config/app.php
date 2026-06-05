<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/DataBase.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
use HTTP\Controllers\LoginController;
$loginController = new LoginController;
