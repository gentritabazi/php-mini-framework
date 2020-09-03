<?php

namespace Core;

use PDO;
use Exception;

class Database
{
    private $dbHost = DB_HOST;
    private $dbPort = DB_PORT;
    private $dbName = DB_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $sql = '';
    private $table = null;
    private $statement = null;

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

    public function table(string $table = null)
    {
        $this->table = $table;

        return $this;
    }

    public function insert(array $fields = [])
    {
        $prefixedFields = preg_filter('/^/', ':', $fields);

        $sql = 'INSERT INTO '. $this->table. ' ('. implode(', ', $fields). ') VALUES ('. implode(', ', $prefixedFields). ')';

        $this->sql = $sql;
        $this->statement = 'insert';

        return $this;
    }

    public function update(array $fields = [])
    {
        $totalFields = count($fields);
        $i = 1;
        $sql = 'UPDATE '. $this->table. ' SET';

        foreach ($fields as $field) {
            $sql .= ' '. $field. ' = :'. $field. (($i == $totalFields) ? null : ',');
            $i++;
        }

        $this->sql = $sql;
        $this->statement = 'update';

        return $this;
    }

    public function where(array $fields = [])
    {
        $sql = ' WHERE';

        foreach ($fields as $value) {
            $sql .= ' '. $value. ' = :'. $value;
        }

        $this->sql .= $sql;

        return $this;
    }

    public function select(array $fields = [])
    {
        $sql = 'SELECT '. implode(', ', $fields). ' FROM '. $this->table;

        $this->sql = $sql;

        return $this;
    }

    public function execute(array $data = [])
    {
        try {
            $stmt = $this->connection();

            $stmt = $stmt->prepare($this->sql);

            if ($stmt->execute(arrayKeyPrefix(':', $data))) {
                if ($this->statement == null) {
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

                return true;
            }

            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(). '. Sql Query: '. $this->sql. '.');
        }
    }
}
