<?php
namespace Lennox\ApiClinica\controllers;
use Lennox\ApiClinica\controllers\Controller;
use Lennox\ApiClinica\models\Doctor;

class DoctorController extends Controller{

    static function registrar()
    {

        $parametros = parent::require(['nombre', 'apellido', 'especializacion', 'genero', 'edad', 'telefono', 'email', 'dni']);
               
        if($parametros['error']){
            return  json_encode($parametros);
        }else{
            $datos = $parametros['parametros'];

            $doctor  = new Doctor;
            http_response_code(201);
            return $doctor->save($datos);
        }


      
    }

    static function get()
    {
        $doctor = new Doctor;
        $doctor = $doctor->get();
        return json_encode($doctor);
 
    }

    static function delete($id){

        $doctor =  new Doctor;

        $doctor = $doctor->delete($id);

        if($doctor){

            return  json_encode(["error" => false, "mensaje"=> "doctor eliminado satifactoriamente"]);

        }else{
            return json_encode( ["error" => true, "mensaje"=> "error al eliminar"]);
        }

      


    }

    static function update($id){



        $parametros = parent::require(['nombre', 'apellido', 'especializacion' ,'genero', 'edad', 'telefono', 'email', 'dni'], false);

        $doctor = new Doctor;

       
      
        if(!is_null($parametros["parametros"])) {
          
            return json_encode($doctor->update($id ,$parametros['parametros']));
        }else{
            return json_encode(["error"=> false, "mensaje"=> "nada por actualizar"]);
        }
    }


}