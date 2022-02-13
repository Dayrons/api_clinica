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