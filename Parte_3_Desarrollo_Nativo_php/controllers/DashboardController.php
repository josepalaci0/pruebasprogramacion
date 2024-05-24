<?php
class DashboardController {
    public function index() {
        
        if (!isset($_SESSION['email'])) {
            header("Location: index.php?action=login");
            exit();
        }
        require __DIR__ . '/../views/dashboard.php';
    }
}
?>
