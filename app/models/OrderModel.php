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
        error_log("data is here: " . $userId . "" . $totalAmount . "");
        $orderData = [
            'userId' => $userId,
            'totalAmount' => $totalAmount,
            'orderStatus' => $orderStatus,
            'paymentMethod' => $paymentMethod
        ];
        return $this->db->insert('orders', $orderData);
    }
    public function updateOrder($orderId, $userId, $totalAmount, $orderStatus, $paymentMethod)
    {
        // Logging the order details for debugging
        error_log("Updating order ID: " . $orderId . " with new data.");

        // Prepare order data for updating
        $orderData = [
            'userId' => $userId,
            'totalAmount' => $totalAmount,
            'orderStatus' => $orderStatus,
            'paymentMethod' => $paymentMethod
        ];

        // Define the condition for updating the correct order
        $condition = ['id' => $orderId];

        // Call the generic update method in the Database class
        return $this->db->update('orders', $orderData, $condition);
    }

    // Clear cart items after placing an order
    public function clearCart($userId)
    {
        return $this->db->delete('cart', 'userId = ' . (int)$userId);
    }
}
