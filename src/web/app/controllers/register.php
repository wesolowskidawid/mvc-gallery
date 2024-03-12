<?php
require_once __DIR__ . '/../models/User.php';

class Register extends Controller
{
    public function index()
    {
        $this->view('register/index');
    }
    public function process()
    {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->view('register/process', ['error' => 'Invalid email address']);
            return;
        }
        if (!User::isUsernameAvailable($username)) {
            $this->view('register/process', ['error' => 'Username is already taken']);
            return;
        }
        if ($password != $password2) {
            $this->view('register/process', ['error' => 'Passwords do not match']);
            return;
        }
        $user = new User($email, $username, password_hash($password, PASSWORD_DEFAULT));
        $user->saveToDatabase();
        $this->view('register/process', ['success' => 'User registered successfully']);
    }
}