<?php
class Products extends Controller
{
    private $productModel;

    public function __construct()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/user/login"); // Redirect to login if not authenticated
            exit();
        }

        // Initialize the Product model
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        // Retrieve all products
        $products = $this->productModel->getAllProducts();
        $data = [
            'products' => $products // Corrected variable name to match the view
        ];
        $this->view('product/index', $data); // Ensure the correct view path
    }

    public function add()
    {
        // Only allow access for admin role
        if ($_SESSION['role'] !== 'admin') {
            header("Location: " . URLROOT . "/products");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and filter input
            $_PRODUCT = filter_input_array(INPUT_POST);
            $data = [
                'productName' => trim($_PRODUCT['productName']),
                'brand' => trim($_PRODUCT['brand']),
                'originalPrice' => trim($_PRODUCT['originalPrice']),
                'sellingPrice' => trim($_PRODUCT['sellingPrice']),
                'weight' => trim($_PRODUCT['weight']) // Added weight field
            ];
            $this->productModel->add($data); // Call the correct model method
            header('Location: ' . URLROOT . '/products');
            exit; // Always exit after redirect
        } else {
            $data = [
                'productName' => '',
                'brand' => '',
                'originalPrice' => '',
                'sellingPrice' => '',
                'weight' => '' // Added weight field
            ];
            $this->view('product/add', $data); // Corrected to 'product/add'
        }
    }

    public function show($id)
    {
        // Retrieve a single product by ID
        $product = $this->productModel->getProductById($id);
        $data = [
            'products' => $product
        ];
        $this->view('product/show', $data); // Corrected to 'product/view'
    }

    public function edit($id)
    {
        // Only allow access for admin role
        if ($_SESSION['role'] !== 'admin') {
            header("Location: " . URLROOT . "/products");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and filter input
            $_PRODUCT = filter_input_array(INPUT_POST);
            $data = [
                'id' => $id,
                'productName' => trim($_PRODUCT['productName']),
                'brand' => trim($_PRODUCT['brand']),
                'originalPrice' => trim($_PRODUCT['originalPrice']),
                'sellingPrice' => trim($_PRODUCT['sellingPrice']),
                'weight' => trim($_PRODUCT['weight']) // Added weight field
            ];
            $this->productModel->edit($data); // Call the correct model method
            header('Location: ' . URLROOT . '/products');
            exit; // Always exit after redirect
        } else {
            // Retrieve product for editing
            $product = $this->productModel->getProductById($id);
            $data = [
                'id' => $id,
                'productName' => $product->productName,
                'brand' => $product->brand,
                'originalPrice' => $product->originalPrice,
                'sellingPrice' => $product->sellingPrice,
                'weight' => $product->weight // Added weight field for editing
            ];
            $this->view('product/edit', $data); // Corrected to 'product/edit'
        }
    }

    public function delete($id)
    {
        // Only allow access for admin role
        if ($_SESSION['role'] !== 'admin') {
            header("Location: " . URLROOT . "/products");
            exit();
        }

        // Call the delete method in the model
        $this->productModel->delete($id);
        header('Location: ' . URLROOT . '/products');
        exit; // Always exit after redirect
    }
}
