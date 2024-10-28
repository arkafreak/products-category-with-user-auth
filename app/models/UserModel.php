<?php
class UserModel
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database(); // Assuming Database class is correctly set up
    }

    public function insertUser($name, $email, $password, $role)
    {
        try {
            $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
            $this->db->query($sql);
            $this->db->bind(':name', $name);
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $password);
            $this->db->bind(':role', $role);

            // Execute the statement and return success status
            return $this->db->execute();
        } catch (Exception $e) {
            // Show error message (for debugging purposes, you can log this instead in production)
            //echo "Failed to insert user: " . $e->getMessage();
            return false; // Return false on error
        }
    }

    public function getUserByEmail($email, $role)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email AND role = :role");
        $this->db->bind(':email', $email);
        $this->db->bind(':role', $role);
        $result = $this->db->single(); // Fetch a single record
        

        return $result; // This should return an object or an associative array
    }
}
