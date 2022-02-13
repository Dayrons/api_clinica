<?php

namespace Lennox\ApiClinica\models;

use Lennox\ApiClinica\Database;

class Model {
    private Database $db;


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
