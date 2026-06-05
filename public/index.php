<?php

require_once __DIR__ . '/../config/app.php';

use HTTP\Router\Router;

Router::get('/', [$loginController, 'mostrarLogin']);
Router::get('/veradmin', [$loginController, 'veradmin']);
Router::comprobarRutas();