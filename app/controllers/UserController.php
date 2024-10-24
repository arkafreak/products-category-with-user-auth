<?php
class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel'); // Ensure UserModel exists
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
        // Load the login view
        $this->view('user/login');
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = $this->userModel->getUserByEmail($email);
           // var_dump($user);
            if ($user) {
                // Check password
                if (password_verify($password, $user->password)) { // Use $user->password if you fetch it as an object
                    session_start();
                    $_SESSION['user_id'] = $user->id; // Assuming you're fetching user as an object
                    $this->view('/choose/options');
                    exit();
                } else {
                    echo "Invalid email or password"; // Debug message
                }
            } else {
                //die("User not found"); // Debug message
            }
        }
    }


    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: " . URLROOT . "/login");
    }
}
