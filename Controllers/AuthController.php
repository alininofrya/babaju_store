<?php

class AuthController {
    protected $userModel;

    public function __construct() {
        require_once 'Models/User.php'; 
        $this->userModel = new User();
    }

    public function index() {
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }

        $data['title'] = 'Login - Babaju';
        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }

    public function login() {
        $data = [
            'title' => 'Login - Babaju',
            'error' => '',
            'username' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $data['username'] = htmlspecialchars($username);

            if (empty($username) || empty($password)) {
                $data['error'] = 'Both username and password are required';
            } else {
                $user = $this->userModel->findByUsername($username);
                if ($user && password_verify($password, $user['password'])) {
                    session_regenerate_id(true);
                    
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['logged_in'] = true;

                    header('Location: /babaju');
                    exit;
                } else {
                    $data['error'] = 'Invalid username or password';
                }
            }
        } else {
            header('Location: /babaju?page=login');
            exit;
        }

        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }
    public function logout() {
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
        }
        if (isset($_SESSION['role'])) {
            unset($_SESSION['role']);
        }
        header('Location: ?page=login');
        exit;
    }
    public function view($view, $data = []) {
        extract($data);
        require_once 'Views/' . $view . '.php';
    }}