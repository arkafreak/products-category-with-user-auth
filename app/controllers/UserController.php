<?php
session_start();
class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {

        $this->userModel = $this->model('UserModel'); // Ensure UserModel exists
        // No need to call session_start() here, as it should be done in bootstrap.php
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

            // Insert user and redirect on success
            if ($this->userModel->insertUser($name, $email, $password)) {
                header("Location: " . URLROOT . "/user/login");
                exit();
            } else {
                echo "Registration failed, please try again.";
            }
        } else {
            // Load the registration view
            $this->view('user/register');
        }
    }

    public function login()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_USER = filter_input_array(INPUT_POST);
            $data = [
                'email' => trim($_USER['email']),
                'password' => trim($_USER['password'])
            ];

            // Fetch user by email
            $user = $this->userModel->getUserByEmail($data['email']);

            if ($user) {
                // Check password
                if (password_verify($data['password'], $user->password)) {
                    // Store user ID in session
                    $_SESSION['user_id'] = $user->id;

                    // Redirect to options page
                    header("Location: " . URLROOT . "/choice/options");
                    exit(); // Always exit after redirect
                } else {
                    echo "Invalid email or password"; // Debug message for invalid password
                }
            } else {
                echo "User not found"; // Debug message for non-existing user
            }
        } else {
            // Load the login view
            $data = ['email' => '', 'password' => ''];
            $this->view('user/login', $data);
        }
    }



    public function logout()
    {
        unset($_SESSION["user_id"]);
        session_destroy();
        header("Location: " . URLROOT . "/login"); // Redirect to login after logout
    }
}
