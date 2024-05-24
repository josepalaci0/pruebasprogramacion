<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->validateCredentials($email, $password)) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['nombre_usuario'] = $this->userModel->getUserNameByEmail($email);
                echo "<script>alert('Usuario logueado'); console.log('Usuario logueado'); window.location.href = 'index.php?action=dashboard';</script>";
                exit();
            } else {
                echo "<script>alert('Correo electrónico o contraseña incorrectos'); console.log('Correo electrónico o contraseña incorrectos');</script>";
            }
        }
        require __DIR__ . '/../views/login.php';
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
}
?>
