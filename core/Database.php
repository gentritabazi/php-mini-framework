<?php

namespace Core;

use PDO;

class Database
{
    private $dbHost = DB_HOST;
    private $dbPort = DB_PORT;
    private $dbName = DB_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;

    public function connection()
    {
        try {
            return new PDO(
                "mysql:host=". $this->dbHost. ";port=". $this->dbPort. ";dbname=". $this->dbName,
                $this->username,
                $this->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (PDOException $exception) {
            exit("Connection error: " . $exception->getMessage(). '.');
        }
    }
}
