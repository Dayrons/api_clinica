<?php

namespace Lennox\ApiClinica\controllers;

use Lennox\ApiClinica\models\Cita;

class CitaController extends Controller {
    static function  get()
    {

        $cita = new Cita();
        $citas = $cita->get();
        return $citas;
       
    }

    public  static function registrarCita()
    {
        $datos = parent::require(["paciente", "doctor"]);
        $cita = new Cita();
        return $cita->save($datos);
 
    }
}