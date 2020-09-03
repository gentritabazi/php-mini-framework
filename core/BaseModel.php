<?php

namespace Core;

use PDO;
use Core\Logger;
use Core\Database;

class BaseModel
{
    public $db;
    protected $primaryKey = 'id';

    // Constructor with $db as database connection.
    public function __construct()
    {
        $db = new Database();
        $this->db = $db;
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
        $fields = $this->getSafeFields();
        array_unshift($fields, $this->primaryKey);

        return $this->db->table($this->tableName)->select($fields)->execute();
    }

    // Get by id
    public function getById($id)
    {
        $fields = $this->getSafeFields();
        array_unshift($fields, $this->primaryKey);

        return $this->db->table($this->tableName)->select($fields)->where(['id'])->execute(['id' => $id]);
    }

    // Create
    public function create(array $data)
    {
        return $this->db->table($this->tableName)->insert($this->fillable)->execute($data);
    }

    // Update
    public function update(array $data, string $id)
    {
        return $this->db->table($this->tableName)->update($this->fillable)->where(['id'])->execute($data + ['id' => $id]);
    }
}
