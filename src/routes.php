<?php

use Lennox\ApiClinica\controllers\CitaController;
use Lennox\ApiClinica\controllers\DoctorController;
use Lennox\ApiClinica\controllers\PacienteController;

$router = new \Bramus\Router\Router();



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config/');
$dotenv->load();

$router->get('/',function(){
  
     require  __DIR__.'/views/index.php' ;
});


$router->get('/cita',function(){echo CitaController::get();});

$router->get('/cita/{dni}',function($dni){echo CitaController::getDni($dni);});

$router->post('/cita',function(){echo( CitaController::registrar());});

$router->delete('/cita/{id}',function($id){echo( CitaController::delete($id));});



$router->get('/doctores',function(){echo DoctorController::get();});

$router->post('/doctores',function(){echo DoctorController::registrar() ;});

$router->put('/doctores/{id}',function($id){echo DoctorController::update($id) ;});

$router->delete('/doctores/{id}',function($id){echo DoctorController::delete($id) ;});

$router->post('/doctores/rechazar-cita/{id}',function($id){echo DoctorController::rechazarCita($id) ;});

$router->post('/doctores/aprobar-cita/{id}',function($id){echo DoctorController::aprobarCita($id) ;});



$router->get('/pacientes',function(){echo PacienteController::get();});

$router->post('/pacientes',function(){echo PacienteController::registrar();});

$router->put('/pacientes/{id}',function($id){echo PacienteController::update($id);});

$router->delete('/pacientes/{id}',function($id){echo PacienteController::delete($id);});


$router->run();

?>