<?php
class DashboardController {
    /**
     * Muestra la página del panel de control.
     */
    public function index() {
        // Verifica si la sesión no está iniciada comprobando si la variable 'email' no está establecida.
        if (!isset($_SESSION['email'])) {
            // Si no hay sesión iniciada, redirige al usuario a la página de inicio de sesión.
            header("Location: index.php?action=login");
            exit();
        }
        // Incluye el archivo de la vista del panel de control.
        require __DIR__ . '/../views/dashboard.php';
    }
}
?>
