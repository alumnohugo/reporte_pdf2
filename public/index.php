<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ReporteController;
use Controllers\DetalleController;


$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/pdf', [ReporteController::class,'pdf']);
$router->get('/detalles', [DetalleController::class,'index']);
$router->get('/API/detalles/buscar', [DetalleController::class,'buscarApi']);
$router->get('/', [AppController::class,'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
