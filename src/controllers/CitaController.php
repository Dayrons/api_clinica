<?php

namespace Lennox\ApiClinica\controllers;

use Lennox\ApiClinica\models\Cita;
use Lennox\ApiClinica\models\Doctor;
use Lennox\ApiClinica\models\Paciente;

class CitaController extends Controller {
    static function  get()
    {

        $cita = new Cita();
        $citas = $cita->get();

        $nuevasCitas  = [];

      
        foreach ($citas as $cita){

            $paciente = new Paciente;

            $paciente = $paciente->getId($cita['paciente']);


            $doctor= new Doctor;

            $doctor = $doctor->getId($cita['doctor']);

            $cita = ["cita" => [
                "id" =>$cita['id'],
                "sintomas" => $cita["sintomas"],
                "paciente" => [ "nombre" => $paciente->nombre, "dni" => $paciente->dni],
                "doctor"  => ["nombre" => $doctor->nombre ,"especialidad" => $doctor->especializacion],
                "status" => $cita["status"]
                ]];

            array_push($nuevasCitas,$cita);

         
        }


        return  json_encode($nuevasCitas);

    }


    
    static function getDni($dni)
    {

        $paciente= new Paciente;

        $paciente = $paciente->getDni($dni);

    

        if(!is_null($paciente)){

         
            $cita = new Cita();
            $citas =  $cita->getId($paciente->id);

         
            $nuevasCitas = [];
            
           
            

            foreach ($citas as $cita){

             

                $doctor= new Doctor;

                $doctor = $doctor->getId($cita['doctor']);

                $cita = ["cita" => ["sintomas" => $cita["sintomas"] ,"doctor"  => ["nombre" => $doctor->nombre ,"especialidad" => $doctor->especializacion]  ]];

                array_push($nuevasCitas,$cita);

             
            }

          
           
            

            return json_encode([
                "paciente"=> [
                    "nombre" => $paciente->nombre,
                    "apellido"=> $paciente->apellido,
                    "dni"=> $paciente->dni
                ],

                "citas" => $nuevasCitas
            ]);

    
        }else{
            http_response_code(401);
            return json_encode(["registro" => false , "mensaje" => "el dni especificado no esta registrado. Debes registrarte para ver tu historial de citas" ]);
        }


        

         

    }

    public  static function registrar()
    {
        $parametros = parent::require([ "sintomas", "dni" , "id_doctor"]);
      

        if($parametros['error']){

            return  json_encode($parametros);

        }else{
            $datos = $parametros['parametros'];
            $paciente= new Paciente;

        $paciente = $paciente->getDni($datos['dni']);

        $doctor = new Doctor;
        $doctor = $doctor->getId($datos['id_doctor']);

        if(!is_null($paciente) && !is_null($doctor)){

            $cita = new Cita();
             $cita->save($paciente, $doctor, $datos['sintomas']);
             http_response_code(201);
            return json_encode(["registro" => true , "mensaje" => "cita registrada satifactoriamente" ]);
    
        }else{
            http_response_code(404);

            if(is_null($paciente)){
                return json_encode(["registro" => false , "mensaje" => "el dni especificado no esta registrado. Debes registrar para poder solicitar una cita" ]);
            }else if(is_null($doctor)){
                return json_encode(["registro" => false , "mensaje" => "el id del doctor indicado no existe, vuelve a la pagina principal y verifica los doctores disponibles" ]);
            }



            
        }
            
        }




        


       
    

        

        
       
 
    }


    static function delete($id){

        $cita =  new Cita;

        $cita = $cita->delete($id);

        if($cita){

            return  json_encode(["error" => false, "mensaje"=> "cita eliminada satifactoriamente"]);

        }else{
            return json_encode( ["error" => true, "mensaje"=> "error al eliminar la cita"]);
        }

      


    }

    
}