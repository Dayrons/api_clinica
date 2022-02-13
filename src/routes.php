<?php

use Lennox\ApiClinica\controllers\CitaController;
use Lennox\ApiClinica\controllers\DoctorController;
use Lennox\ApiClinica\controllers\PacienteController;

$router = new \Bramus\Router\Router();



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config/');
$dotenv->load();

$router->get('/',function(){
    echo 'hola mundo';
});

$router->get('/cita',function(){echo CitaController::get();});

$router->post('/cita',function(){echo( CitaController::registrarCita());});

$router->get('/doctores',function(){echo DoctorController::get();});
$router->post('/doctores',function(){echo DoctorController::registrarDoctor() ;});

$router->get('/pacientes',function(){echo PacienteController::get();});
$router->post('/pacientes',function(){echo PacienteController::get();});


$router->run();