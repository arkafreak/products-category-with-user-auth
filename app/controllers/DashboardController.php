<?php

class DashboardController extends Controller
{

    private $orderModel;

    public function __construct()
    {
        Helper::startSession();
        if (!Helper::isLoggedIn() || $_SESSION['role'] !== 'admin') {
            Helper::redirect(URLROOT . "/UserController/login");
        }

        // Load the OrderModel
        $this->orderModel = $this->model('OrderModel');
    }

    public function index()
    {
        // Fetch all purchased products with date and time
        $purchasedProducts = $this->orderModel->getAllPurchasedProducts();
        
        // Group products by date and time
        $groupedProducts = $this->groupProductsByDate($purchasedProducts);
        // Fetch sales by payment method data
        $salesData = $this->orderModel->getSalesByPaymentMethod();
        // Fetch the total revewnue over time
        $revenueData = $this->orderModel->getRevenueOverTime();

        $this->view('dashboard/index', [
            'groupedProducts' => $groupedProducts,
            'salesData' => $salesData,
            'revenueData' => $revenueData
        ]);
    }

    // Function to group products by purchase date and time
    private function groupProductsByDate($products)
    {
        $grouped = [];
        foreach ($products as $product) {
            // Format the date and time
            $dateTime = date('Y-m-d H:i', strtotime($product->purchase_date));  // Format as Date and Time (e.g., 2024-11-07 12:30)

            // Group by the formatted date and time
            if (!isset($grouped[$dateTime])) {
                $grouped[$dateTime] = [];
            }
            $grouped[$dateTime][] = $product;
        }
        return $grouped;
    }
}
