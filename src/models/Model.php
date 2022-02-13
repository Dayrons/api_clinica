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

    
}
