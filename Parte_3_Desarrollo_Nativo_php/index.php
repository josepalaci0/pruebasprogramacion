<?php
// Inicia una nueva sesión o reanuda la existente.
session_start();

// Requiere los archivos de los controladores necesarios.
require_once 'controllers/AuthController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/LogoutController.php';

// Determina la acción a realizar, predeterminando 'login' si no se especifica ninguna.
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Realiza una acción basada en el valor de 'action'.
switch ($action) {
    case 'login':
        // Si la acción es 'login', crea una instancia de AuthController y llama al método login.
        $authController = new AuthController();
        $authController->login();
        break;
    case 'register':
        // Si la acción es 'register', crea una instancia de UserController y llama al método register.
        $userController = new UserController();
        $userController->register();
        break;
    case 'dashboard':
        // Si la acción es 'dashboard', crea una instancia de DashboardController y llama al método index.
        $dashboardController = new DashboardController();
        $dashboardController->index();
        break;
    case 'logout':
        // Si la acción es 'logout', crea una instancia de LogoutController y llama al método logout.
        $logoutController = new LogoutController();
        $logoutController->logout();
        break;
    default:
        // Si la acción no coincide con ninguna de las anteriores, muestra un mensaje de error.
        echo "Página no encontrada";
        break;
}
?>
