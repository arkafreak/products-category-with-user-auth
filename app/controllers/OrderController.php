<?php


class OrderController extends Controller
{
    private $orderModel;
    private $cartModel;
    private $mailController;

    public function __construct()
    {
        // Ensure the user is logged in
        Helper::startSession();
        if (!Helper::isLoggedIn()) {
            Helper::redirect(URLROOT . "/UserController/login");
        }

        $this->orderModel = $this->model('OrderModel');
        $this->cartModel = $this->model('CartModel');
        // Instantiate MailController
        $this->mailController = new MailController();
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

        // Save the order to the database with status "pending"
        $orderId = $this->orderModel->createOrder($userId, $totalAmount, 'pending', $paymentMethod);

        $orderId = $this->orderModel->getLatestOrderIdByUserId($userId);

        // echo "$orderId";
        // Redirect to the payment page based on selected method
        if ($paymentMethod === 'paypal') {
            $this->view('paypal/index');
        } elseif ($paymentMethod === 'stripe') {
            $this->view('stripe/index', ['orderId' => $orderId, 'totalAmount' => $totalAmount]);
        } else {
            // Handle invalid payment methods if necessary
            echo "Invalid payment method selected.";
        }
    }

    public function checkout()
    {
        if (!Helper::isLoggedIn()) {
            Helper::redirect(URLROOT . "/UserController/login");
        }

        $userId = $_SESSION['user_id'];

        $cartItems = $this->cartModel->getCartItems($userId);

        // foreach ($cartItems as $item) {
        //     echo "Product Name: " . $item->productName . "<br>";
        //     echo "Selling Price: " . $item->sellingPrice . "<br>";
        //     echo "Quantity: " . $item->quantity . "<br><br>";
        // }
        $selectedItems = [];

        foreach ($cartItems as $item) {
            // Add only productName, sellingPrice, and quantity to the new array
            $selectedItems[] = [
                'productName' => $item->productName,
                'sellingPrice' => $item->sellingPrice,
                'quantity' => $item->quantity
            ];
        }

        $orderId = $this->orderModel->getLatestOrderIdByUserId($userId);

        $totalAmount = $this->orderModel->getTotalAmountByOrderId($orderId);

        $paymentMethod = $this->orderModel->getPaymentMethodByOrderId($orderId);

        // Update the order status to 'completed'
        $this->orderModel->updateOrderStatus($orderId, 'completed');

        // Clear the cart after successful order
        $this->orderModel->clearCart($userId);

        // Retrieve the user's email
        $userModel = $this->model('UserModel');
        $userEmail = $userModel->getEmailById($userId);
        $username = $userModel->getUserNameById($userId);
        
        // Send email notification

        $this->mailController->sendTransactionEmail($userEmail, $username, $orderId, $totalAmount, $paymentMethod, $selectedItems);

        $this->view('order/success');
    }
}
