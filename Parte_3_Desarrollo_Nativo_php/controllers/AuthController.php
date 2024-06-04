<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $userModel;

    /**
     * Constructor de la clase AuthController.
     * Inicializa una instancia del modelo de usuario.
     */
    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * Maneja el inicio de sesión del usuario.
     */
    public function login() {
        // Verifica si el método de la solicitud es POST.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtiene el email y la contraseña enviados mediante POST.
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Valida las credenciales del usuario utilizando el modelo de usuario.
            if ($this->userModel->validateCredentials($email, $password)) {
                // Inicia una nueva sesión o reanuda la existente.
                session_start();
                // Almacena el email del usuario en la sesión.
                $_SESSION['email'] = $email;
                // Almacena el nombre del usuario en la sesión obteniéndolo desde el modelo de usuario.
                $_SESSION['nombre_usuario'] = $this->userModel->getUserNameByEmail($email);
                // Muestra un mensaje de alerta, registra en la consola del navegador y redirige al panel de control.
                echo "<script>alert('Usuario logueado'); console.log('Usuario logueado'); window.location.href = 'index.php?action=dashboard';</script>";
                exit();
            } else {
                // Muestra un mensaje de alerta y registra en la consola del navegador si las credenciales son incorrectas.
                echo "<script>alert('Correo electrónico o contraseña incorrectos'); console.log('Correo electrónico o contraseña incorrectos');</script>";
            }
        }
        // Incluye el archivo de la vista de inicio de sesión.
        require __DIR__ . '/../views/login.php';
    }

    /**
     * Maneja el cierre de sesión del usuario.
     */
    public function logout() {
        // Inicia una nueva sesión o reanuda la existente.
        session_start();
        // Elimina todas las variables de sesión.
        session_unset();
        // Destruye la sesión.
        session_destroy();
        // Redirige al usuario a la página de inicio de sesión.
        header("Location: index.php?action=login");
        exit();
    }
}
?>
