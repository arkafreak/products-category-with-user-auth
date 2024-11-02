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

    public function addressPayment()
    {
        //echo "Working";
        $userId = $_SESSION['user_id'];
        $cartItems = $this->cartModel->getCartItems($userId);

        // Calculate total amount
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->sellingPrice * $item->quantity;
        }

        // Pass data to the view
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
            Helper::redirect(URLROOT . "/UserController/login");
        }

        $userId = $_SESSION['user_id'];

        // Validate and sanitize input data
        $paymentMethod = htmlspecialchars($_POST['paymentMethod']); // Get the payment method from the form

        // Calculate total amount
        $cartItems = $this->cartModel->getCartItems($userId);
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->sellingPrice * $item->quantity;
        }

        // Save the order to the database with status "completed"
        $this->orderModel->createOrder($userId, $totalAmount, 'completed', $paymentMethod);

        // Clear the cart after successful order
        $this->orderModel->clearCart($userId);

        // Redirect to the paypal payment page
        $this->view('paypal/index');
    }
}
