<?php
namespace Lennox\ApiClinica\controllers;
use Lennox\ApiClinica\controllers\Controller;
use Lennox\ApiClinica\models\Paciente;

class PacienteController extends Controller{

static function registrarPaciente()
{

    $parametros = parent::require(['nombre', 'apellido',  'genero', 'edad', 'telefono', 'email', 'dni']);

    if($parametros['error']){
        return json_encode($parametros);
    }else{
        $datos = $parametros["parametros"];
        $paciente  = new Paciente;
        http_response_code(201);
        return $paciente->save($datos);
    }


    
    
}

static function get()
{
    $paciente = new Paciente;

    $paciente = $paciente->get();
    return  json_encode($paciente);
}

static function delete($id){
    $paciente =  new Paciente;

        $paciente = $paciente->delete($id);

        if($paciente){

            return  json_encode(["error" => false, "mensaje"=> "paciente eliminado satifactoriamente"]);

        }else{
            return json_encode( ["error" => true, "mensaje"=> "error al eliminar"]);
        }

}

   


}