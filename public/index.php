<?php

require_once __DIR__ . '/../config/app.php';

$router->post('/login', [$loginController, 'login']);
$router->get('/users', [$adminController, 'getPersonas'], 'administrador');
$router->post('/register', [$adminController, 'register'], 'administrador');
$router->get('/update/', [$adminController, 'update'], 'administrador');
$router->post('/delete/', [$adminController, 'delete'], 'administrador');
$router->post('/update-passwd', [$personaController, 'updatePasswd'], 'all');
$router->comprobarRutas();