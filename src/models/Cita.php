<?php

namespace Lennox\ApiClinica\models;



class Cita  extends Model{ 

    private Doctor $doctor;
    private $fecha;
    private Clinica $clinica;
    private Paciente $paciente;


    
}