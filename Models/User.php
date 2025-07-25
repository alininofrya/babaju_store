<?php
require_once __DIR__ . '/../Core/Database.php';

class User {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Secure method to find user by username
    public function findByUsername($username) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameter securely to prevent SQL injection
        $stmt->bindParam(':username', $username);
        
        $stmt->execute();
        
        // Return the user data as associative array or false if not found
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}