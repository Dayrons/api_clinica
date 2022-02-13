<?php

namespace Lennox\ApiClinica\models;

use PDO;
use PDOException;

class Paciente extends Model{ 
    private string $id; 
    private int $edad;
    private string $genero;
    private string $estatura;
    private string $peso;
    private string $cedula;
    private string $telefono;

    public function save($campos)
    {
        try {
            $exist =  $this->exist($campos['dni'], $campos['email']);
            if(!$exist){
                $query = $this->prepare("INSERT INTO pacientes(nombre, apellido,  genero, edad, telefono, email, dni) VALUES ( :nombre, :apellido,  :genero, :edad, :telefono, :email, :dni)");

                $query->execute($campos);
                return json_encode(['registro'=> true, "mensaje"=> "paciente registrado satifactoriamente"]);
            }else{
                return json_encode(['registro'=> false, "mensaje"=> "ya existe un paciente con los siguientes datos"]);
            }

            

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

        
    
        
    }

    public function get()
    {
        try {
            
           

            $query = $this->query("SELECT * FROM pacientes ");
            return json_encode($query->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

    }

    private function exist($dni, $email)
    {

      
        $query = $this->prepare("SELECT COUNT(*) FROM pacientes WHERE dni= ? OR email = ? ");

        $query->execute([
           $dni,
            $email
        ]);

        $row = $query->fetch(PDO::FETCH_NUM);

       

        if($row[0] == 1){

            return true;

        }

    
        return false;

    }
}
