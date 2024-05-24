<?php
session_start();

require_once 'controllers/AuthController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/LogoutController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'login':
        $authController = new AuthController();
        $authController->login();
        break;
    case 'register':
        $userController = new UserController();
        $userController->register();
        break;
    case 'dashboard':
        $dashboardController = new DashboardController();
        $dashboardController->index();
        break;
    case 'logout':
        $logoutController = new LogoutController();
        $logoutController->logout();
        break;
    default:
        echo "Página no encontrada";
        break;
}
?>
