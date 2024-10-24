<?php
class Controller {
    // Method to load the model
    public function model($model) {
        // Require the model file based on the model name
        require_once '../app/models/' . $model . '.php';
        // Instantiate the model and return the instance
        return new $model();
    }

    // Method to load the view
    public function view($view, $data = []) {
        // Check if the view file exists
        if (file_exists('../app/views/' . $view . '.php')) {
            // Extract data to make it available in the view
            extract($data);
            // Require the view file
            require_once '../app/views/' . $view . '.php';
        } else {
            // Display an error if the view does not exist
            die('View does not exist');
        }
    }
}
