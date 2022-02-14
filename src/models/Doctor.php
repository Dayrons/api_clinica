<?php

namespace Lennox\ApiClinica\models;

use PDO;
use PDOException;

class Doctor extends Model{
    public ?int $id;
    public ?string $dni;
    public ?string $nombre;
    public ?string $apellido;
    public ?string $especializacion;
    public ?string $genero;
    public ?int $edad;
    public ?string $telefono;
    public ?string $password;

    public function __construct(
        $id =  null,
        $dni = null,
        $edad = null,
        $nombre = null,
        $apellido = null,
        $especializacion = null,
        $genero = null,
        $telefono = null,
        $email =  null,
        $password= null,

    ) {
        
        $this->id= $id;
        $this->dni= $dni;
        $this->edad= $edad;
        $this->nombre= $nombre;
        $this->apellido= $apellido;
        $this->especializacion = $especializacion;
        $this->genero= $genero;
        $this->telefono= $telefono;
        $this->email= $email;
        $this->password = $password;


        $this->modelo = 'doctores';
        parent::__construct();
        
    }


    public function save($campos)
    {
        try {
            $exist = $this->exist($campos['dni'],$campos['email']);

        
            if(!$exist){

                $campos['password'] = password_hash($campos['password'],  PASSWORD_DEFAULT);

                $query = $this->prepare("INSERT INTO doctores(nombre, apellido, especializacion, genero, edad, telefono, email, password , dni) VALUES ( :nombre, :apellido, :especializacion, :genero, :edad, :telefono, :email ,:password , :dni)");

                $query->execute($campos);

                return json_encode(['registro'=> true, "mensaje"=> "doctor registrado satifactoriamente"]);


            }else{
                return json_encode(['registro'=> false, "mensaje"=> "ya existe un doctor con los siguientes datos"]);

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
            
            $query = $this->query("SELECT * FROM doctores ");
            return $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

    }

    private function exist($dni, $email)
    {

      
        $query = $this->prepare("SELECT COUNT(*) FROM doctores WHERE dni= ? OR email = ? ");

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

    public function update($id, $parametros){

        
        $doctor = $this->getId($id);

        try {
            if (!is_null($doctor)) {
                $query = $this->prepare("UPDATE doctores SET edad= ?,  nombre= ?, apellido= ?, genero=?,telefono= ?,   email=?, especializacion=?  WHERE id=$doctor->id");

                $query->execute(
                    [
                        array_key_exists('edad', $parametros) ?  $parametros['edad']  : $doctor->edad,
                        array_key_exists('nombre', $parametros) ?  $parametros['nombre'] : $doctor->nombre,
                        array_key_exists('apellido', $parametros)  ? $parametros['apellido'] : $doctor->apellido,
                        array_key_exists('genero', $parametros)  ?  $parametros['genero']  : $doctor->genero,
                        array_key_exists('telefono', $parametros) ? $parametros['telefono']  :  $doctor->telefono,
                        array_key_exists('email', $parametros)   ? $parametros['email']  :  $doctor->email,
                        array_key_exists('especializacion', $parametros) ?  $parametros['especializacion']  : $doctor->especializacion,

                    ]

                );

                if ($query->rowCount() > 0) {

                    return ['error' => false, 'mensaje' => 'campos actualizados'];
                } else {
                    return ['error' => true, 'mensaje' => 'nada por actualizar'];
                }
            } else {

                return ['error' => true, 'mensaje' => 'el id especificado no conincide con ningun doctor'];

            }
            

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }

    

    }


    public function getId($id){
        
        try {
            
            $query = $this->query("SELECT * FROM doctores WHERE id=$id");

            $doctor  = $query->fetch(PDO::FETCH_ASSOC);

            if($query->rowCount() == 1){

                return new Doctor(
                    $doctor['id'],
                    $doctor['dni'],
                    $doctor['edad'],
                    $doctor['nombre'],
                    $doctor['apellido'],
                    $doctor['especializacion'],
                    $doctor['genero'],
                    $doctor['telefono'],
                    $doctor['email'],
                    $doctor['password'],
                   
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
            
            $query = $this->query("SELECT * FROM doctores WHERE dni=$dni");

            $doctor  = $query->fetch(PDO::FETCH_ASSOC);

            if($query->rowCount() == 1){
                return new Doctor(
                    $doctor['id'],
                    $doctor['dni'],
                    $doctor['edad'],
                    $doctor['nombre'],
                    $doctor['apellido'],
                    $doctor['especializacion'],
                    $doctor['genero'],
                    $doctor['telefono'],
                    $doctor['email'],
                    $doctor['password'],
                   
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
    

    public function validar($dni, $password)
    {  
        $doctor = $this->getDni($dni);

       

        if(!is_null($doctor)){



            if(password_verify($password, $doctor->password)){


                return ['acceso'=>true , 'doctor'=>$doctor,];

            }
            else{
                return ['acceso'=>false , 'mensaje'=>'contraseña invalida'];
            }


            

        }else{
            return ['acceso'=>false , "mensaje'=>'no existe un doctor con el siguiente dni: $dni"];
        }

        

    }
}