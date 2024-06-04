<?php
class LogoutController {
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
