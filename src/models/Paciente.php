<?php

namespace Lennox\ApiClinica\models;

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
            $query = $this->prepare("INSERT INTO pacientes(nombre, apellido,  genero, edad, telefono, dni) VALUES ( :nombre, :apellido,  :genero, :edad, :telefono, :dni)");

        $query->execute($campos);

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

        
    
        
    }

}
