<?php

namespace Core;

use PDO;
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

    // Get all
    public function get()
    {
        $query = "SELECT ". implode(", ", $this->fillable). " FROM ". $this->table_name;

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
