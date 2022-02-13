<?php

namespace Lennox\ApiClinica\models;

use PDO;
use PDOException;

class Cita  extends Model{



    // public function __construct(
    //     private Doctor $doctor,
    //     private $fecha,
    //     private Clinica $clinica,
    //     private Paciente $paciente,
    // ) {}


    public function save($campos)
    {
        try {
            $query = $this->prepare("INSERT INTO citas(doctor,paciente) VALUES (:doctor, :paciente)");

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
            
            $query = $this->query("SELECT * FROM citas LIMIT 100");
            return json_encode($query->fetchAll(PDO::FETCH_ASSOC));

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

    }
}