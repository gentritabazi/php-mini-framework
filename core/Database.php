<?php

namespace Core;

use PDO;

class Database
{
    // Specify your own database credentials.
    private $host = DB_HOST;
    private $dbPort = DB_PORT;
    private $dbName = DB_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    public $conn;
  
    // Get the database connection.
    public function getConnection()
    {
        $this->conn = null;
  
        try {
            $this->conn = new PDO("mysql:host=". $this->host. ";port=". $this->dbPort. ";dbname=". $this->dbName,
                $this->username,
                $this->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}