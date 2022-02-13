<?php

namespace Lennox\ApiClinica\models;

use PDO;
use PDOException;

class Cita  extends Model{

   /*  private Doctor $doctor;
    private $fecha;
    private Paciente $paciente; 
    private Clinica $clinica;
    private string $sintomas; */

    public function __construct() {
        $this->modelo =  'citas';

        parent::__construct();
    }
    


 
    public function save(Paciente $paciente, Doctor $doctor, string $sintomas)
    {
        try {
            
        $query = $this->prepare("INSERT INTO citas(doctor,paciente,  sintomas) VALUES (:doctor, :paciente, :sintomas)");

        $query->execute([
            'paciente'=> $paciente->id,
            'doctor'=> $doctor->id,
            'sintomas' => $sintomas,
        ]);

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

        
    
        
    }

    public function getId($id)
    {

        try {
            
            $query = $this->query("SELECT * FROM citas WHERE paciente=$id");
            return $query->fetchAll(PDO::FETCH_ASSOC);

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
            return $query->fetchAll(PDO::FETCH_ASSOC);


        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

    }
}