<?php

namespace Lennox\ApiClinica\models;

use PDO;
use PDOException;

class Cita  extends Model
{
    public ?int $id;
    public ?int $doctor;
    public ?int $paciente;
    public ?string $sintomas;
    public ?string $status;

    public function __construct(
        $id = null,
        $doctor = null,
        $paciente = null,
        $sintomas = null,
        $status = null
    ) {
        $this->modelo =  'citas';
        $this->id = $id;
        $this->doctor = $doctor;
        $this->paciente = $paciente;
        $this->sintomas = $sintomas;
        $this->status = $status;


        parent::__construct();
    }




    public function save(Paciente $paciente, Doctor $doctor, string $sintomas)
    {
        try {

            $query = $this->prepare("INSERT INTO citas(doctor,paciente,  sintomas, status ) VALUES (:doctor, :paciente, :sintomas, :status)");

            $query->execute([
                'paciente' => $paciente->id,
                'doctor' => $doctor->id,
                'sintomas' => $sintomas,
                'status' => 'pendiente'
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

            $query = $this->query("SELECT * FROM citas WHERE id=$id");

            $cita  = $query->fetch(PDO::FETCH_ASSOC);

            if ($query->rowCount() == 1) {

                return new cita(
                    $cita['id'],
                    $cita['doctor'],
                    $cita['paciente'],
                    $cita['sintomas'],
                    $cita['status']

                );
            } else {
                return null;
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

            $query = $this->query("SELECT * FROM citas LIMIT 100");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {

            print_r($e->getMessage());
            error_log($e->getMessage());
            return false;
        }
    }

    public function aprobar($id){


        try {
            $query = $this->query("UPDATE citas SET status='aprobada'  WHERE id=$id");

            if ($query->rowCount() > 0) {

                return ['error' => false, 'mensaje' => 'cita aprobada'];
            } else {
                return ['error' => false, 'mensaje' => 'la cita ya esta aprobada'];
            }
            

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }
    }

    public function rechazar($id){
        try {
            $query = $this->query("UPDATE citas SET status='rechazada'  WHERE id=$id");

            if ($query->rowCount() > 0) {

                return ['error' => false, 'mensaje' => 'cita rechazada'];
            } else {
                return ['error' => false, 'mensaje' => 'la cita ya esta rechazada'];
            }
            

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }
    }
}
