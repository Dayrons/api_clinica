<?php

namespace Lennox\ApiClinica\controllers;

class Controller {

    
    static function require(array $parametros)
    {
        $post = @file_get_contents('php://input');    
        $post =  json_decode( $post, true ); 
        $validacion =  true;
        $values =[];
        foreach ($parametros as $parametro) {

            if(!empty($post[$parametro])){

                $values[$parametro] = $post[$parametro];
                
            }else{
                $validacion = false;
                break;
            }

        }

        if($validacion){
            return $values;
        }

        else{
            http_response_code(401);
            return ["mensaje" => "parametro invalidos"];
        }
      
        
    }
    
    public function render( string $nombre, array $data = []){
        require __DIR__ . "/src/$nombre" . '.php';
    }
}