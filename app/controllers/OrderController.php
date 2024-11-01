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

        Helper::redirect(URLROOT . '/cart');
    }
}
