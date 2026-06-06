<?php
# Punto de entrada de la aplicación

# Se encarga de cargar la configuración y definir las rutas de la aplicación
require_once __DIR__ . '/../config/app.php';

# Rutas en formato metodo(url-path, controller-object, middleware)
$router->post('/login', [$loginController, 'login']);
$router->get('/users', [$adminController, 'getPersonas'], 'administrador');
$router->post('/register', [$adminController, 'register'], 'administrador');
$router->get('/update/', [$adminController, 'update'], 'administrador');
$router->post('/delete/', [$adminController, 'delete'], 'administrador');
$router->post('/update-passwd', [$personaController, 'updatePasswd'], 'all');
# Comprobar las rutas y ejecutar el controlador correspondiente
$router->comprobarRutas();