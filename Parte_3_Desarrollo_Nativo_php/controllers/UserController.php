<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    /**
     * Constructor de la clase UserController.
     * Inicializa una instancia del modelo de usuario.
     */
    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * Maneja el registro de un nuevo usuario.
     */
    public function register() {
        // Verifica si el método de la solicitud es POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtiene el nombre, el email y la contraseña enviados mediante POST.
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Intenta crear un nuevo usuario utilizando el modelo de usuario.
            $result = $this->userModel->create($nombre, $email, $password);
            if ($result === true) {
                // Muestra un mensaje de alerta, registra en la consola del navegador y redirige a la página de inicio de sesión si el registro es exitoso.
                echo "<script>alert('Registro exitoso.'); console.log('Registro exitoso.'); window.location.href = 'index.php?action=login';</script>";
                exit();
            } else {
                // Muestra un mensaje de alerta y registra en la consola del navegador si hay un error al registrar el usuario.
                echo "<script>alert('Error al registrar el usuario: " . $result . "'); console.log('Error al registrar el usuario: " . $result . "');</script>";
            }
        }
        // Incluye el archivo de la vista de registro.
        require __DIR__ . '/../views/register.php';
    }
}
?>
