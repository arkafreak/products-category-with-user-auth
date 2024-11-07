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
    public function getTotalAmountByOrderId()
    {
        $table = 'orders';
        $columns = 'totalAmount';
        $where = '1 ORDER BY id DESC LIMIT 1'; // Placeholder condition

        $result = $this->db->select($table, $columns, $where);

        // Return the total amount if found, otherwise return null
        return $result ? $result[0]->totalAmount : null;
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
    public function getPaymentMethodByOrderId($orderId)
    {
        $result = $this->db->select('orders', 'paymentMethod', "id = $orderId");
        return $result ? $result[0]->paymentMethod : null; // Assuming result is an array of objects
    }

    public function getLatestOrderIdByUserId($userId)
    {
        // Query to select the latest order ID for a specific user
        $query = "SELECT MAX(id) AS latestOrderId FROM orders WHERE userId = :userId";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the latest order ID if found, otherwise return null
        return $result ? $result['latestOrderId'] : null;
    }


    //Part for order_items table!
    public function addOrderItem($orderId, $productId, $quantity)
    {
        $query = "INSERT INTO order_items (orderId, productId, quantity) VALUES (:orderId, :productId, :quantity)";
        $this->db->query($query);
        $this->db->bind(':orderId', $orderId);
        $this->db->bind(':productId', $productId);
        $this->db->bind(':quantity', $quantity);
        $this->db->execute();
    }

    public function getAllPurchasedProducts()
    {
        // Query to fetch products ordered by createdAt timestamp (grouped by date and time)
        $query = "SELECT p.id, p.productName, p.brand, oi.quantity, o.createdAt AS purchase_date
                  FROM order_items oi
                  JOIN products p ON oi.productId = p.id
                  JOIN orders o ON oi.orderId = o.id
                  WHERE o.orderStatus = 'completed'
                  ORDER BY o.createdAt DESC";

        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Inside your DashboardController (or relevant controller)
    public function getSalesByPaymentMethod()
    {
        // Query to fetch sales grouped by payment method
        $query = "
            SELECT paymentMethod, SUM(totalAmount) AS total_sales
            FROM orders
            WHERE orderStatus = 'completed'
            GROUP BY paymentMethod
        ";

        // Execute the query
        $this->db->query($query);
        return $this->db->resultSet(); // Fetch all results
    }
}
