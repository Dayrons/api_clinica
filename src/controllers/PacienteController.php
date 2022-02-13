<?php
namespace Lennox\ApiClinica\controllers;
use Lennox\ApiClinica\controllers\Controller;
use Lennox\ApiClinica\models\Paciente;

class PacienteController extends Controller{

static function registrarPaciente()
{
    $datos = parent::require(['nombre', 'apellido',  'genero', 'edad', 'telefono', 'email', 'dni']);

    $paciente  = new Paciente;

    return $paciente->save($datos);
    
}

static function get()
{
    $paciente = new Paciente;

    return $pacientes = $paciente->get();
}


}