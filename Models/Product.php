<?php
// File: babaju/Models/Product.php

// Pastikan jalur ke Core/Database.php sudah benar
// Jika di dalam Models/, maka 'Core/Database.php' harusnya cukup karena index.php yang melakukan autoload
// Tapi untuk memastikan, kita pakai __DIR__
require_once __DIR__ . '/../Core/Database.php';

class Product {
    private $conn; // Mengubah nama properti dari $db menjadi $conn agar sesuai dengan kode Anda
    private $table = 'products';

    // Properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $image_url; // Mengikuti penamaan properti Anda
    public $category_id;
    public $stock_quantity;
    public $created_at;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get All Products (Sudah benar di kode Anda, saya hanya memastikan return type untuk konsistensi)
    public function getAllProducts() {
        $query = "SELECT p.*, c.name as category_name
                  FROM " . $this->table . " p
                  LEFT JOIN categories c ON p.category_id = c.id
                  ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // Mengembalikan statement, jadi controller yang akan fetchAll
        return $stmt;
    }

    // Get Product by ID (Sudah benar di kode Anda)
    public function getProductById($id) {
        $query = "SELECT p.*, c.name as category_name
                  FROM " . $this->table . " p
                  LEFT JOIN categories c ON p.category_id = c.id
                  WHERE p.id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get Products by Category ID (Sudah benar di kode Anda)
    public function getProductsByCategoryId($category_id) {
        $query = "SELECT p.*, c.name as category_name
                  FROM " . $this->table . " p
                  LEFT JOIN categories c ON p.category_id = c.id
                  WHERE p.category_id = :category_id
                  ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt; // Mengembalikan statement, controller akan fetchAll
    }

    // Create Product (Sudah sesuai dengan pendekatan Anda, saya hanya sedikit merapikan)
    public function createProduct() {
        $query = "INSERT INTO " . $this->table . "
                    SET
                        name = :name,
                        description = :description,
                        price = :price,
                        image_url = :image_url,
                        category_id = :category_id,
                        stock_quantity = :stock_quantity,
                        created_at = NOW()";

        $stmt = $this->conn->prepare($query);

        // Sanitize data (sudah ada di kode Anda, bagus!)
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->stock_quantity = htmlspecialchars(strip_tags($this->stock_quantity));

        // Bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':stock_quantity', $this->stock_quantity);

        if ($stmt->execute()) {
            return true;
        }
        // Cetak error jika debugging diperlukan
        // printf("Error: %s.\n", $stmt->errorInfo()[2]);
        return false;
    }

    // Update Product (Menyesuaikan dengan gaya createProduct Anda, menggunakan properti kelas)
    public function updateProduct() { // Method ini diharapkan akan diisi properti kelas terlebih dahulu
        $query = "UPDATE " . $this->table . "
                    SET
                        name = :name,
                        description = :description,
                        price = :price,
                        image_url = :image_url,
                        category_id = :category_id,
                        stock_quantity = :stock_quantity
                    WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Sanitize data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->stock_quantity = htmlspecialchars(strip_tags($this->stock_quantity));

        // Bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':image_url', $this->image_url);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':stock_quantity', $this->stock_quantity);

        if ($stmt->execute()) {
            return true;
        }
        // Cetak error jika debugging diperlukan
        // printf("Error: %s.\n", $stmt->errorInfo()[2]);
        return false;
    }


    // Delete Product (Sudah benar di kode Anda)
    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        // Cetak error jika debugging diperlukan
        // printf("Error: %s.\n", $stmt->errorInfo()[2]);
        return false;
    }

    // --- BARU: countAll() method ---
    public function countAll() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query); // Menggunakan $this->conn bukan $this->db
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}