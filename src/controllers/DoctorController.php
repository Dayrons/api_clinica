<?php

namespace Lennox\ApiClinica\controllers;

use Lennox\ApiClinica\controllers\Controller;
use Lennox\ApiClinica\models\Cita;
use Lennox\ApiClinica\models\Doctor;

class DoctorController extends Controller
{

    static function registrar()
    {

        $parametros = parent::require(['nombre', 'apellido', 'especializacion', 'genero', 'edad', 'telefono', 'email', 'dni', 'password']);


        if ($parametros['error']) {
            return  json_encode($parametros);
        } else {
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

    static function delete($id)
    {

        $doctor =  new Doctor;

        $doctor = $doctor->delete($id);

        if ($doctor) {

            return  json_encode(["error" => false, "mensaje" => "doctor eliminado satifactoriamente"]);
        } else {
            return json_encode(["error" => true, "mensaje" => "error al eliminar"]);
        }
    }

    static function update($id)
    {



        $parametros = parent::require(['nombre', 'apellido', 'especializacion', 'genero', 'edad', 'telefono', 'email', 'dni'], false);

        $doctor = new Doctor;



        if (!is_null($parametros["parametros"])) {

            return json_encode($doctor->update($id, $parametros['parametros']));
        } else {
            return json_encode(["error" => false, "mensaje" => "nada por actualizar"]);
        }
    }

    static function aprobarCita($id)
    {

        $parametros = parent::require(['dni', 'password']);
        

        if ($parametros['error']) {

            return json_encode($parametros);

        } else {

            $doctor = new Doctor;

            $password = $parametros['parametros']['password'];

            $dni = $parametros['parametros']['dni'];

            $acceso = $doctor->validar($dni, $password);

            if($acceso['acceso']){

                $cita= new Cita;
                $doctor = $acceso['doctor'];
                $cita = $cita->getId($id);


                if(!is_null($cita)){

                    

                    if($cita->doctor == $doctor->id){
                        
                        return json_encode($cita->aprobar($cita->id));

                    }else{
                        return json_encode(['error'=> true, 'mensaje'=> 'la cita que deseas modificar esta relaccionado con otro doctor']);
                    }
    
                   
                }else{
                    return json_encode(['error'=> true, 'mensaje'=> 'no existe una cita con el id indicado']);
                }

            }else{
                return json_encode($acceso);
            }


        }
    }


    static function rechazarCita($id)
    {
        $parametros = parent::require(['dni', 'password']);
        

        if ($parametros['error']) {

            return json_encode($parametros);

        } else {

            $doctor = new Doctor;

            $password = $parametros['parametros']['password'];

            $dni = $parametros['parametros']['dni'];

            $acceso = $doctor->validar($dni, $password);

            if($acceso['acceso']){

                $cita= new Cita;
                $doctor = $acceso['doctor'];
                $cita = $cita->getId($id);


                if(!is_null($cita)){

                    

                    if($cita->doctor == $doctor->id){
                        
                        return json_encode($cita->rechazar($cita->id));

                    }else{
                        return json_encode(['error'=> true, 'mensaje'=> 'la cita que deseas modificar esta relaccionado con otro doctor']);
                    }
    
                   
                }else{
                    return json_encode(['error'=> true, 'mensaje'=> 'no existe una cita con el id indicado']);
                }

            }else{
                return json_encode($acceso);
            }


        }

        
    }

    static function listarCitas(){
        $parametros = parent::require(['dni', 'password']);

        if($parametros['error']){
            return json_encode($parametros);
        }else{

            $doctor= new Doctor;

            $password = $parametros['parametros']['password'];
            $dni = $parametros['parametros']['dni'];
            $acceso =$doctor->validar( $dni, $password);


            if($acceso['acceso']){

                $doctor= $acceso['doctor'];

                $cita = new Cita;

                return json_encode( $citas = $cita->getDoctorId($doctor->id));

            }else{

                return json_encode($acceso);
            }

            

        }

    }
}
