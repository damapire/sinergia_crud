<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController extends App\Core\Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);
            if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['rol'] = $user['rol'];
                header('Location: /dashboard');
                exit;
            } else {
                $error = 'Correo o contraseña incorrectos';
                $this->view('user/login', ['error' => $error]);
            }
        } else {
            $this->view('user/login');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
