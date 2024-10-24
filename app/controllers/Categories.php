<?php
class Categories extends Controller {
    private $categoryModel;

    public function __construct() {
        // Initialize the Category model
        $this->categoryModel = $this->model('Category');
    }

    public function index() {
        // Retrieve all categories
        $categories = $this->categoryModel->getAllCategories();
        $data = [
            'categories' => $categories // Corrected variable name to match the view
        ];
        $this->view('category/index', $data); // Ensure the correct view path
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and filter input
            $_CATEGORY = filter_input_array(INPUT_POST);
            $data = [
                'categoryName' => trim($_CATEGORY['categoryName'])
            ];
            $this->categoryModel->add($data); // Call the correct model method
            header('Location: ' . URLROOT . '/categories');
            exit; // Always exit after redirect
        } else {
            $data = [
                'categoryName' => '' // Empty field for new category
            ];
            $this->view('category/add', $data); // Corrected to 'categories/add'
        }
    }
    
    public function show($id) {
        // Retrieve a single category by ID
        $category = $this->categoryModel->getCategoryById($id);
        $data = [
            'category' => $category
        ];
        $this->view('category/show', $data); // Corrected to 'categories/show'
    }
    
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize and filter input
            $_CATEGORY = filter_input_array(INPUT_POST);
            $data = [
                'id' => $id,
                'categoryName' => trim($_CATEGORY['categoryName'])
            ];
            $this->categoryModel->edit($data); // Call the correct model method
            header('Location: ' . URLROOT . '/categories');
            exit; // Always exit after redirect
        } else {
            // Retrieve category for editing
            $category = $this->categoryModel->getCategoryById($id);
            $data = [
                'id' => $id,
                'categoryName' => $category->categoryName
            ];
            $this->view('category/edit', $data); // Corrected to 'categories/edit'
        }
    }
    
    public function delete($id) {
        // Call the delete method in the model
        $this->categoryModel->delete($id);
        header('Location: ' . URLROOT . '/categories');
        exit; // Always exit after redirect
    }
}
?>
