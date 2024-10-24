<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Get all products
    public function getAllProducts() {
        $this->db->query('SELECT * FROM products');
        return $this->db->resultSet();
    }

    // Add a new product
    public function add($data) {
        $this->db->query('INSERT INTO products (productName, brand, originalPrice, sellingPrice, weight) VALUES (:productName, :brand, :originalPrice, :sellingPrice, :weight)');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':weight', $data['weight']); // Bind the weight directly
        return $this->db->execute(); // Return true on success
    }

    // Get a product by ID
    public function getProductById($id) {
        $this->db->query('SELECT * FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Edit a product
    public function edit($data) {

        $data['weight'] = isset($data['weight']) && !empty($data['weight']) ? $data['weight'] : 0;

        $this->db->query('UPDATE products SET productName = :productName, brand = :brand, originalPrice = :originalPrice, sellingPrice = :sellingPrice, weight = :weight WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':weight', $data['weight']); // Bind the weight directly
        return $this->db->execute(); // Return true on success
    }

    // Delete a product
    public function delete($id) {
        $this->db->query('DELETE FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute(); // Return true on success
    }
}
?>
