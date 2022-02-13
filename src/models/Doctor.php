<?php

namespace Lennox\ApiClinica\models;

use PDO;
use PDOException;

class Doctor extends Model{
    private string $id;
    private string $nombre;
    private string $apellido;
    private string $especializacion;
    private string $genero;
    private int $edad;
    private string $telefono;

    public function save($campos)
    {
        try {
            $query = $this->prepare("INSERT INTO doctores(nombre, apellido, especializacion, genero, edad, telefono, dni) VALUES ( :nombre, :apellido, :especializacion, :genero, :edad, :telefono, :dni)");

        $query->execute($campos);

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

        
    
        
    }

    public function get()
    {
        try {
            
            $query = $this->query("SELECT * FROM doctores ");
            return json_encode($query->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

    }

}