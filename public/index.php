<?php

/**
 * Punto de entrada principal del sistema
 * Todas las peticiones pasan por aquí.
 */

// Cargar la clase principal del sistema MVC
require_once __DIR__ . '/../app/core/App.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';

use App\Core\App;

// Iniciar la aplicación
$app = new App();