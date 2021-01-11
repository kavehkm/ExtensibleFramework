<?php
namespace EF;


use PDO;
use DateTime;
use PDOException;


class DatabaseTable
{
    private $pdo;
    private $table;
    private $primaryKey;

    public function __construct(PDO $pdo, string $table, string $primaryKey)
    {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    private function query($sql, $parameters = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($parameters);
        return $query;
    }

    private function processDates($fields)
    {
        foreach ($fields as $key => $value) {
            if ($value instanceof DateTime) {
                $fields[$key] = $value->format('Y-m-d');
            }
        }
        return $fields;
    }

    public function total()
    {
        $sql = 'SELECT COUNT(*) FROM `' . $this->table . '`';
        $row = $this->query($sql)->fetch();
        return $row[0];
    }

    public function findById($id)
    {
        $sql = 'SELECT * FROM `' . $this->table . '` WHERE `'. $this->primaryKey . '` = :id';
        $parameters = [
            'id' => $id
        ];
        return $this->query($sql, $parameters)->fetch();
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM `' . $this->table . '` WHERE `' . $this->primaryKey . '` = :id';
        $parameters = [
            'id' => $id
        ];
        $this->query($sql, $parameters);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM `' . $this->table . '`';
        return $this->query($sql)->fetchAll();
    }

    private function insert($fields)
    {
        $sql = 'INSERT INTO `' . $this->table . '` (';
        foreach ($fields as $key => $value) {
            $sql .= '`' . $key . '`,';
        }
        $sql = rtrim($sql, ',');
        $sql .= ') VALUES (';
        foreach ($fields as $key => $value) {
            $sql .= ':' . $key . ',';
        }
        $sql = rtrim($sql, ',');
        $sql .= ')';
        $fields = $this->processDates($fields);
        $this->query($sql, $fields);
    }

    private function update($fields)
    {
        $sql = 'UPDATE `' . $this->table . '` SET ';
        foreach ($fields as $key => $value) {
            $sql .= '`' . $key . '` = :' . $key . ',';
        }
        $sql = rtrim($sql, ',');
        $sql .= ' WHERE `' . $this->primaryKey . '` = :' . $this->primaryKey;
        $fields = $this->processDates($fields);
        $this->query($sql, $fields);
    }

    public function save($record)
    {
        try {
            if ($record[$this->primaryKey] == '') {
                $record[$this->primaryKey] = null;
            }
            $this->insert($record);
        } catch (PDOException $e) {
            $this->update($record);
        }
    }
}