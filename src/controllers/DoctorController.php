<?php
namespace Lennox\ApiClinica\controllers;
use Lennox\ApiClinica\controllers\Controller;
use Lennox\ApiClinica\models\Doctor;

class DoctorController extends Controller{

    static function registrarDoctor()
    {


        $datos = parent::require(['nombre', 'apellido', 'especializacion', 'genero', 'edad', 'telefono', 'email', 'dni']);

        $doctor  = new Doctor;

        return $doctor->save($datos);
    }

    static function get()
    {
        $doctor = new Doctor;
        $doctor = $doctor->get();
        return json_encode($doctor);
 
    }

   


}