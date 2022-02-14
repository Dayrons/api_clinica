<?php

namespace Lennox\ApiClinica\models;

use PDO;
use PDOException;

class Paciente extends Model{ 
    public ?int $id ;
    public ?string $dni ; 
    public ?int $edad;
    public ?string $nombre ;
    public ?string $apellido ;
    public ?string $genero;
    public ?string $telefono;
    public ?string $email ;


 
    

    public function __construct(
        $id =  null,
        $dni = null,
        $edad = null,
        $nombre = null,
        $apellido = null,
        $genero = null,
        $telefono = null,
        $email =  null,
    )
    {
        $this->id= $id;
        $this->dni= $dni;
        $this->edad= $edad;
        $this->nombre= $nombre;
        $this->apellido= $apellido;
        $this->genero= $genero;
        $this->telefono= $telefono;
        $this->email= $email;

        $this->modelo = 'pacientes';
        parent::__construct();
        
    }
    

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
            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

    }

    public function getId($id){
        
        try {
            
            $query = $this->query("SELECT * FROM pacientes WHERE id=$id");

            $paciente  = $query->fetch(PDO::FETCH_ASSOC);

            if($query->rowCount() == 1){

                return new Paciente(
                    $paciente['id'],
                    $paciente['dni'],
                    $paciente['edad'],
                    $paciente['nombre'],
                    $paciente['apellido'],
                    $paciente['genero'],
                    $paciente['telefono'],
                    $paciente['email'],
                   
                ); 

            }else{
                return null;
            }

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }
    }


    public function getDni($dni){
        try {
            
            $query = $this->query("SELECT * FROM pacientes WHERE dni=$dni");

            $paciente  = $query->fetch(PDO::FETCH_ASSOC);

            if($query->rowCount() == 1){
                return new Paciente(
                    $paciente['id'],
                    $paciente['dni'],
                    $paciente['edad'],
                    $paciente['nombre'],
                    $paciente['apellido'],
                    $paciente['genero'],
                    $paciente['telefono'],
                    $paciente['email'],
                   
                ); 

            }else{
                return null;
            }

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }
    }


    public function update($id, $parametros){

        $paciente = $this->getId($id);
           

        try {

            if (!is_null($paciente)) {
                $query = $this->prepare("UPDATE pacientes SET edad= ?,  nombre= ?, apellido= ?, genero=?, telefono= ?, email=?   WHERE id=$paciente->id");

                $query->execute(
                    [
                        array_key_exists('edad', $parametros) ?  $parametros['edad']  : $paciente->edad,
                        array_key_exists('nombre', $parametros) ?  $parametros['nombre'] : $paciente->nombre,
                        array_key_exists('apellido', $parametros)  ? $parametros['apellido'] : $paciente->apellido,
                        array_key_exists('genero', $parametros)  ?  $parametros['genero']  : $paciente->genero,
                        array_key_exists('telefono', $parametros) ? $parametros['telefono']  :  $paciente->telefono,
                        array_key_exists('email', $parametros)   ? $parametros['email']  :  $paciente->email,

                    ]

                );

                if ($query->rowCount() > 0) {

                    return ['error' => false, 'mensaje' => 'campos actualizados'];
                } else {
                    return ['error' => true, 'mensaje' => 'nada por actualizar'];
                }
            }else{
                return ['error' => true, 'mensaje' => 'el id especificado no coincide con ningun paciente'];
            }

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

        return $paciente;

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
