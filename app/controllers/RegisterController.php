<?php
// controllers/RegisterController.php
class RegisterController {
    public function index() {
        // Mostrar formulario de registro
        require_once __DIR__ . '/../views/register.php';
    }
    
    public function process() {
        // Procesar el registro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lógica de registro
        }
    }
}
?>