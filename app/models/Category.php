<?php
class Category {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Get all categories
    public function getAllCategories() {
        $this->db->query('SELECT * FROM categories');
        return $this->db->resultSet();
    }

    // Add a new category
    public function add($data) {
        $this->db->query('INSERT INTO categories (categoryName) VALUES (:categoryName)');
        $this->db->bind(':categoryName', $data['categoryName']);
        return $this->db->execute(); // Return true on success
    }

    // Get a category by ID
    public function getCategoryById($id) {
        $this->db->query('SELECT * FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Edit a category
    public function edit($data) {
        $this->db->query('UPDATE categories SET categoryName = :categoryName WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':categoryName', $data['categoryName']);
        return $this->db->execute(); // Return true on success
    }

    // Delete a category
    public function delete($id) {
        $this->db->query('DELETE FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute(); // Return true on success
    }
}
?>
