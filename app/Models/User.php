<?php

namespace App\Models;

use Core\BaseModel;

class User extends BaseModel
{
    // Table name.
    private $table_name = "users";
  
    // Object properties.
    public $first_name;
    public $last_name;
    public $email;
    public $password;

    // Get all
    public function get()
    {
        $query = "SELECT first_name, last_name FROM ". $this->table_name;

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Create
    public function create()
    {
        $query = "INSERT INTO $this->table_name (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
  
        $stmt = $this->db->prepare($query);

        if ($stmt->execute(array(
            $this->first_name,
            $this->last_name,
            $this->email,
            $this->password
        ))) {
            return true;
        }
      
        return false;
    }
}
