<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Assuming Database class is correctly set up
    }

    public function insertUser($name, $email, $password) {
        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $this->db->query($sql);
            $this->db->bind(':name', $name);
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $password);

            // Execute the statement and return success status
            return $this->db->execute();
        } catch (Exception $e) {
            // Show error message (for debugging purposes, you can log this instead in production)
            echo "Failed to insert user: " . $e->getMessage();
            return false; // Return false on error
        }
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        return $this->db->single();
    }
}
?>
