<?php
class OrderController extends Controller
{
    private $orderModel;
    private $cartModel;

    public function __construct()
    {
        // Ensure the user is logged in
        Helper::startSession();
        if (!Helper::isLoggedIn()) {
            Helper::redirect(URLROOT . "/UserController/login");
        }

        $this->orderModel = $this->model('OrderModel');
        $this->cartModel = $this->model('CartModel');
    }

    public function placeOrder()
    {
        $userId = $_SESSION['user_id'];
        $cartItems = $this->cartModel->getCartItems($userId);

        // Calculate total amount
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->sellingPrice * $item->quantity;
        }

        // Insert order and order items
        $orderId = $this->orderModel->createOrder($userId, $totalAmount);
        if ($orderId) {
            $this->orderModel->clearCart($userId);
            Helper::flashMessage("Order placed successfully!", "success");
        } else {
            Helper::flashMessage("Failed to place order.", "error");
        }

        Helper::redirect(URLROOT . '/CartController');
    }
    public function addressPayment()
    {
        $userId = $_SESSION['user_id'];
        $cartItems = $this->cartModel->getCartItems($userId);

        // Calculate total amount
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->sellingPrice * $item->quantity;
        }

        // Pass the cart items and total amount to the view
        $data = [
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount
        ];

        $this->view('order/address_payment', $data);
    }


    public function confirm()
    {
        // Ensure the user is logged in
        if (!Helper::isLoggedIn()) {
            Helper::redirect(URLROOT . '/UserController/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the address and payment method from the form
            $address = Helper::sanitizeInput($_POST['address']);
            $paymentMethod = Helper::sanitizeInput($_POST['paymentMethod']);

            // Prepare order data including address and payment method
            $orderData = [
                'userId' => $_SESSION['order']['userId'],
                'totalAmount' => $_SESSION['order']['totalAmount'],
                'address' => $address, // Assuming you have added this field to your orders table
                'paymentMethod' => $paymentMethod // Assuming you have added this field to your orders table
            ];

            // Save the order using the OrderModel
            $orderId = $this->orderModel->createOrder($orderData);

            // Clear the cart after placing the order
            if ($orderId) {
                $this->cartModel->clearCart($orderData['userId']);
                Helper::flashMessage("Order placed successfully!", "success");
            } else {
                Helper::flashMessage("Failed to place order.", "error");
            }

            // Redirect to a confirmation page or orders list
            Helper::redirect(URLROOT . '/orders');
        } else {
            // If the method is not POST, redirect back to the address and payment page
            Helper::redirect(URLROOT . '/order/addressPayment');
        }
    }
}
