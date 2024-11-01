<?php
class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get all products
    public function getAllProducts()
    {
        return $this->db->select('products p LEFT JOIN categories c ON p.categoryId = c.id', 'p.*, c.categoryName');
    }

    // Add a new product
    public function add($data)
    {
        return $this->db->insert('products', $data);
    }

    // Get a product by ID
    public function getProductById($id)
    {
        return $this->db->select(
            'products p LEFT JOIN categories c ON p.categoryId = c.id',
            'p.*, c.categoryName',
            'p.id = ' . (int)$id // Using direct integer conversion
        )[0] ?? null; // Return the first result or null if not found
    }


    // Edit a product
    public function edit($data)
    {
        $where = 'id = ' . (int)$data['id']; // Ensure id is safely cast to an integer
        return $this->db->update('products', $data, $where);
    }

    // Delete a product
    public function delete($id)
    {
        return $this->db->delete('products', 'id = ' . (int)$id); // Directly using integer
    }

    // Get products by category ID
    public function getProductsByCategoryId($categoryId)
    {
        return $this->db->select(
            'products',
            '*',
            'categoryId = ' . (int)$categoryId // Using direct integer conversion
        );
    }
}
