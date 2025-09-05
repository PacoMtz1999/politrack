<?php
class DashboardController {
    public function index() {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Verificar si el usuario está logueado
        if (!isset($_SESSION['user_id'])) {
            // Redirigir al login si no está autenticado
            header('Location: index.php?controller=Login&action=index');
            exit();
        }
        
        // Mostrar dashboard
        require_once __DIR__ . '/../views/dashboard.php';
    }
    
    public function process() {
        // Procesar el registro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lógica de registro
        }
    }
}
?>