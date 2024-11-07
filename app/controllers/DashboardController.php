<?php

class DashboardController extends Controller
{

    private $orderModel;

    public function __construct()
    {
        Helper::startSession();
        if (!Helper::isLoggedIn() || $_SESSION['role'] !== 'admin') {
            Helper::redirect(URLROOT . "UserController/login");
        }

        // Load the OrderModel
        $this->orderModel = $this->model('OrderModel');
    }

    public function index()
    {
        
        $purchasedProducts = $this->orderModel->getAllPurchasedProducts();
        
        $this->view('dashboard/index', ['purchasedProducts' => $purchasedProducts]);
    }
}
