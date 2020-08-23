<?php

namespace Core;

use PDO;
use Core\Logger;
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

    // Get safe fields
    public function getSafeFields()
    {
        foreach ($this->fillable as $key => $value) {
            if (in_array($value, $this->hidden)) {
                unset($this->fillable[$key]);
            }
        }

        return $this->fillable;
    }

    // Get all
    public function get()
    {
        $query = "SELECT ". implode(", ", $this->getSafeFields()). " FROM ". $this->table_name;

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
