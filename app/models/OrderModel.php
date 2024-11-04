<?php
class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Create a new order
    public function createOrder($userId, $totalAmount, $orderStatus, $paymentMethod)
    {
        error_log("data is here: " . $userId . " " . $totalAmount . " " . $paymentMethod);

        $orderData = [
            'userId' => $userId,
            'totalAmount' => $totalAmount,
            'paymentMethod' => $paymentMethod,
            'orderStatus' => $orderStatus
            // 'orderStatus' is omitted; the database will use its default value
        ];

        return $this->db->insert('orders', $orderData);
    }

    public function updateOrderStatus($orderId, $status)
    {
        $stmt = $this->db->prepare("UPDATE orders SET orderStatus = :status WHERE id = :orderId");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':orderId', $orderId);

        return $stmt->execute(); // Returns true on success
    }
    public function getTotalAmountByOrderId($orderId)
    {
        $stmt = $this->db->prepare("SELECT totalAmount FROM orders WHERE id = :orderId");
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the total amount if found, otherwise return null
        return $result ? $result['totalAmount'] : null;
    }

    public function updateOrder($orderId, $status)
    {
        $data = ['orderStatus' => $status];
        return $this->db->update('orders', $data, "id = $orderId");
    }


    // Clear cart items after placing an order
    public function clearCart($userId)
    {
        return $this->db->delete('cart', 'userId = ' . (int)$userId);
    }

    public function getUserEmailById($userId)
    {
        // SQL query to select the email of the user based on userId
        $query = "SELECT email FROM users WHERE id = :userId";
        $params = [':userId' => $userId];

        // Use the `select` function from Database.php to fetch the email
        $result = $this->db->select($query, $params);

        // If email is found, return it; otherwise, return null
        return $result ? $result[0]['email'] : null;
    }
}
