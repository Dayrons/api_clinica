<?php

use Lennox\ApiClinica\controllers\CitaController;
use Lennox\ApiClinica\controllers\DoctorController;
use Lennox\ApiClinica\controllers\PacienteController;

$router = new \Bramus\Router\Router();



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config/');
$dotenv->load();

$router->get('/',function(){
    $html = file_get_contents(  __DIR__.'/views/index.php');
     print $html ;
});

$router->get('/cita',function(){echo CitaController::get();});

$router->get('/cita/{dni}',function($dni){echo CitaController::getDni($dni);});

$router->post('/cita',function(){echo( CitaController::registrarCita());});

$router->delete('/cita/{id}',function($id){echo( CitaController::delete($id));});


$router->get('/doctores',function(){echo DoctorController::get();});

$router->post('/doctores',function(){echo DoctorController::registrarDoctor() ;});

$router->delete('/doctores/{id}',function($id){echo DoctorController::delete($id) ;});



$router->get('/pacientes',function(){echo PacienteController::get();});
$router->post('/pacientes',function(){echo PacienteController::registrarPaciente();});


$router->run();

?>