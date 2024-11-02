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
    {   error_log("data is here: ". $userId ."". $totalAmount ."");
        $orderData = [
            'userId' => $userId,
            'totalAmount' => $totalAmount,
            'orderStatus' => $orderStatus,
            'paymentMethod' => $paymentMethod
        ];
        return $this->db->insert('orders', $orderData);
    }

    // Clear cart items after placing an order
    public function clearCart($userId)
    {
        return $this->db->delete('cart', 'userId = ' . (int)$userId);
    }

    
}
