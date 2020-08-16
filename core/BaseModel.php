<?php

namespace Core;

use Core\Database;

class BaseModel
{
    public $db;

    // Constructor with $db as database connection.
    public function __construct()
    {
        $db = new Database();
        $this->db = $db->getConnection();
    }
}
