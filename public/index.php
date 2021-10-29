<?php 

require __DIR__ . '/../includes/app.php';
use MVC\Router; 
use Controllers\AgendaController;


$router = new Router;

//rutas principales 

$router->get('/agenda' , [AgendaController::class , 'muestraAgenda'] );
$router->get('/models/actualizar' , [AgendaController::class , 'actualizarAgenda'] );
$router->get('/models/eliminar' , [AgendaController::class , 'eliminarAgenda'] );
$router->get('/models/contacto' , [AgendaController::class , 'contacto'] );

$router->validarRutas();














