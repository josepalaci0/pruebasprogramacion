<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->userModel->create($nombre, $email, $password);
            if ($result === true) {
                echo "<script>alert('Registro exitoso.'); console.log('Registro exitoso.'); window.location.href = 'index.php?action=login';</script>";
                exit();
            } else {
                echo "<script>alert('Error al registrar el usuario: " . $result . "'); console.log('Error al registrar el usuario: " . $result . "');</script>";
            }
        }
        require __DIR__ . '/../views/register.php';
    }
}
?>
