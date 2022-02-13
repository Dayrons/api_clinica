<?php

namespace Lennox\ApiClinica\controllers;

class Controller {

    
    static function require(array $parametros)
    {
        $post = @file_get_contents('php://input');    
        $post =  json_decode( $post, true ); 
        $validacion =  true;
        $values =[];
        $parametros_faltantes = '';
        foreach ($parametros as $parametro) {

            if(!empty($post[$parametro])){

                $values[$parametro] = $post[$parametro];
                
            }else{
                $parametros_faltantes .= $parametro . ", ";

                $validacion = false;
            }

        }

        if($validacion){
            return ["error" => false , 'parametros'=> $values];
           
        }

        else{
            http_response_code(400);
            return ["error" => true, "mensaje" => "faltan parametros los siguientes parametros para relizar el registro: $parametros_faltantes"];
        }
      
        
    }
    
    public function render( string $nombre, array $data = []){
        require __DIR__ . "/src/$nombre" . '.php';
    }
}