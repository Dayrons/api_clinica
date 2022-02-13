<?php
namespace Lennox\ApiClinica\controllers;
use Lennox\ApiClinica\controllers\Controller;
use Lennox\ApiClinica\models\Doctor;

class DoctorController extends Controller{

    static function registrarDoctor()
    {
        $datos = parent::require(['nombre', 'apellido', 'especializacion', 'genero', 'edad', 'telefono', 'dni']);

        $doctor  = new Doctor;

        $doctor->save($datos);
    }

    static function get()
    {
        
    }


}