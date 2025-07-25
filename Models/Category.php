<?php
// File: babaju/Models/Category.php

require_once 'Core/Database.php';

class Category {
    private $conn;
    private $table = 'categories';

    public $id;
    public $name;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    private function prepareAndExecute($query, $bindParams = []) {
        $stmt = $this->conn->prepare($query);
        foreach ($bindParams as $param => $value) {
            $type = PDO::PARAM_STR;
            if (is_int($value)) {
                $type = PDO::PARAM_INT;
            } elseif (is_bool($value)) {
                $type = PDO::PARAM_BOOL;
            } elseif (is_null($value)) {
                $type = PDO::PARAM_NULL;
            }
            $stmt->bindValue($param, $value, $type);
        }
        $stmt->execute();
        return $stmt;
    }

    public function getAllCategories() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->prepareAndExecute($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->prepareAndExecute($query, [':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}