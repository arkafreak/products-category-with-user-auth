<?php
class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Create a new order
    public function createOrder($userId, $totalAmount)
    {
        $orderData = [
            'userId' => $userId,
            'totalAmount' => $totalAmount
        ];
        return $this->db->insert('orders', $orderData);
    }

    // Clear cart items after placing an order
    public function clearCart($userId)
    {
        return $this->db->delete('cart', 'userId = ' . (int)$userId);
    }

    
}
