<?php

namespace Lennox\ApiClinica\models;

use PDO;
use PDOException;

class Cita  extends Model{

    


   /*  public function __construct(
        // private Doctor $doctor,
        // private $fecha,
        // private Paciente $paciente, 
        // private Clinica $clinica,
        // private string $sintomas,
    ) {} */


    public function save($campos)
    {
        try {
            
        $query = $this->prepare("INSERT INTO citas(doctor,paciente, clinica, sintomas) VALUES (:doctor, :paciente, :clinica, :sintomas)");

        $query->execute($campos);

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

        
    
        
    }

    public function getDni($dni)
    {

        try {
            
            $query = $this->query("SELECT * FROM citas WHERE dni=$dni");
            return json_encode($query->fetchAll(PDO::FETCH_ASSOC));

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