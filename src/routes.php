<?php

use Lennox\ApiClinica\controllers\CitaController;
$router = new \Bramus\Router\Router();



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config/');
$dotenv->load();

$router->get('/',function(){
    echo 'hola mundo';
});

$router->get('/cita',function(){echo CitaController::get();});

$router->post('/cita',function(){print_r( CitaController::registrarCita());});

$router->get('/doctores',function(){echo CitaController::get();});
$router->post('/doctores',function(){echo CitaController::get();});

$router->get('/pacientes',function(){echo CitaController::get();});
$router->post('/pacientes',function(){echo CitaController::get();});


$router->run();