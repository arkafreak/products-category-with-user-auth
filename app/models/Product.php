<?php
class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get all products
    // public function getAllProducts()
    // {
    //     $this->db->query('SELECT * FROM products');
    //     return $this->db->resultSet();
    // }

    public function getAllProducts()
    {
        $this->db->query("
        SELECT products.*, categories.categoryName
        FROM products
        LEFT JOIN categories ON products.categoryId = categories.id
        ");
        return $this->db->resultSet(); // This should return all products with their category names
    }

    // Add a new product
    public function add($data)
    {
        $this->db->query('INSERT INTO products (productName, brand, originalPrice, sellingPrice, weight, categoryId) VALUES (:productName, :brand, :originalPrice, :sellingPrice, :weight, :categoryId)');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':weight', $data['weight']); // Bind the weight directly
        $this->db->bind(':categoryId', $data['categoryId']);
        return $this->db->execute(); // Return true on success
    }

    // Get a product by ID
    public function getProductById($id)
    {
        $sql = "
        SELECT products.*, categories.categoryName
        FROM products
        JOIN categories ON products.categoryId = categories.id
        WHERE products.id = :id
        ";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Edit a product
    public function edit($data)
    {

        $data['weight'] = isset($data['weight']) && !empty($data['weight']) ? $data['weight'] : 0;

        $this->db->query('UPDATE products SET productName = :productName, brand = :brand, originalPrice = :originalPrice, sellingPrice = :sellingPrice, weight = :weight, categoryId = :categoryId WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':brand', $data['brand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':weight', $data['weight']); // Bind the weight directly
        $this->db->bind(':categoryId', $data['categoryId']);
        return $this->db->execute(); // Return true on success
    }

    // Delete a product
    public function delete($id)
    {
        $this->db->query('DELETE FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute(); // Return true on success
    }

    // Get products by category ID
    public function getProductsByCategoryId($categoryId)
    {
        $this->db->query("SELECT * FROM products WHERE categoryId = :categoryId");
        $this->db->bind(':categoryId', $categoryId);
        return $this->db->resultSet(); // Fetch multiple rows
    }
}
