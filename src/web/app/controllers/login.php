<?php
require_once __DIR__ . '/../models/User.php';

class Login extends Controller {
    public function index() {
        $this->view('login/index');
    }
    public function process() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $user = User::loadByUsername($username);
        if (!$user) {
            $this->view('login/index', ['error' => 'Invalid username or password']);
            return;
        }
        if (!password_verify($password, $user->password)) {
            $this->view('login/index', ['error' => 'Invalid username or password']);
            return;
        }
        session_start();
        $_SESSION['user_id'] = $user->getId();
        header('Location: /public');
    }
}