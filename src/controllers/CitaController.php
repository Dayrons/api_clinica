<?php

namespace Lennox\ApiClinica\controllers;

use Lennox\ApiClinica\models\Cita;
use Lennox\ApiClinica\models\Clinica;
use Lennox\ApiClinica\models\Doctor;
use Lennox\ApiClinica\models\Paciente;

class CitaController extends Controller {
    static function  get()
    {

        $cita = new Cita();
        $citas = $cita->get();
        return $citas;

    }

    static function getDni($dni){

        $cita =  new Cita;

        return $citas =  $cita->getDni($dni);

         

    }

    public  static function registrarCita()
    {
        $datos = parent::require(["paciente", "doctor", "clinica", "sintomas"]);

        $doctor = new Doctor();
        $paciente =  new Paciente();
        $clinica = new Clinica();

        
        $cita = new Cita();
        return $cita->save($datos);
 
    }

    
}