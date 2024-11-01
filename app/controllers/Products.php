<?php
class Products extends Controller
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        // Start session and check if user is logged in
        Helper::startSession();
        if (!Helper::isLoggedIn()) {
            Helper::redirect(URLROOT . "/UserController/login"); // Redirect to login if not authenticated
        }

        // Initialize the Product and Category models
        $this->productModel = $this->model('Product');
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {
        // Retrieve all products
        $products = $this->productModel->getAllProducts();
        $data = [
            'products' => $products
        ];
        $this->view('product/index', $data);
    }

    public function add()
    {
        // Only allow access for admin role
        if (!Helper::isAdmin()) {
            Helper::redirect(URLROOT . "/products");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and filter input
            $_PRODUCT = filter_input_array(INPUT_POST);
            $data = [];
            foreach (Helper::getProductFields() as $field) {
                $data[$field] = Helper::sanitizeInput($_PRODUCT[$field] ?? '');
            }

            $this->productModel->add($data);
            Helper::flashMessage('Product added successfully.');
            Helper::redirect(URLROOT . '/products');
        } else {
            $categories = $this->categoryModel->getAllCategories();
            $data = array_merge(array_fill_keys(Helper::getProductFields(), ''), ['categories' => $categories]);
            $this->view('product/add', $data);
        }
    }

    public function show($id)
    {
        // Retrieve a single product by ID
        $product = $this->productModel->getProductById($id);

        if (!$product) {
            Helper::flashMessage('Product not found.', 'error');
            Helper::redirect(URLROOT . '/products');
            return;
        }

        $data = [
            'product' => $product
        ];
        $this->view('product/show', $data);
    }

    public function edit($id)
    {
        // Only allow access for admin role
        if (!Helper::isAdmin()) {
            Helper::redirect(URLROOT . "/products");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_PRODUCT = filter_input_array(INPUT_POST);
            $data = ['id' => $id];
            foreach (Helper::getProductFields() as $field) {
                $data[$field] = Helper::sanitizeInput($_PRODUCT[$field] ?? '');
            }

            $this->productModel->edit($data);
            Helper::flashMessage('Product updated successfully.');
            Helper::redirect(URLROOT . '/products');
        } else {
            $product = $this->productModel->getProductById($id);
            $categories = $this->categoryModel->getAllCategories();

            if ($product) {
                $data = ['id' => $id, 'categories' => $categories];
                foreach (Helper::getProductFields() as $field) {
                    $data[$field] = $product->$field ?? '';
                }
                $this->view('product/edit', $data);
            } else {
                Helper::flashMessage('Product not found.', 'error');
                Helper::redirect(URLROOT . '/products');
            }
        }
    }

    public function delete($id)
    {
        // Only allow access for admin role
        if (!Helper::isAdmin()) {
            Helper::redirect(URLROOT . "/products");
        }

        $this->productModel->delete($id);
        Helper::flashMessage('Product deleted successfully.');
        Helper::redirect(URLROOT . '/products');
    }
}
