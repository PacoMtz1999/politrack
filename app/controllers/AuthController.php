<?php
// controllers/AuthController.php
class AuthController {
    public function forgotPassword() {
        // Mostrar formulario de recuperación de contraseña
        require_once __DIR__ . '/../views/auth-forgot-password.php';
    }
    
    public function processForgotPassword() {
        // Procesar la recuperación de contraseña
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lógica para recuperar contraseña
        }
    }
}
?>