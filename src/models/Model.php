<?php

namespace Lennox\ApiClinica\models;

use Lennox\ApiClinica\Database;
use PDO;
use PDOException;

class Model {
    private Database $db;
    public $modelo = '';


    public function __construct() {
        $this->db = new Database();
        
        
    }

    public function query($query)
    {

        return $this->db->connet()->query($query);
        
    }
    public function prepare($query)
    {

        return $this->db->connet()->prepare($query);
        
    }

    public function delete($id)
    {
        try {
            
            $query = $this->query("DELETE  FROM $this->modelo WHERE id=$id");

            if($query->rowCount() > 0){

                return true;

            }else{
                return false;
            }

        } catch (PDOException $e) {

            print_r($e->getMessage());
                error_log($e->getMessage());
                return false;
        }
    }

    
}
