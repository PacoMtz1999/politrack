<?php
require_once __DIR__ . '/../models/LoginModel.php';

class LoginController {
    public function index() {
        // Muestra la vista de login
        require_once __DIR__ . '/../views/login.php';
    }
    
    public function authenticate() {
        // Verificar que sea una petición POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener y limpiar los datos del formulario
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            
            // Validaciones básicas
            if (empty($email) || empty($password)) {
                $error = "Por favor, complete todos los campos";
                require_once __DIR__ . '/../views/login.php';
                return;
            }
            
            // Instanciar el modelo y verificar credenciales
            $model = new LoginModel();
            $user = $model->checkCredentials($email, $password);
            
            if ($user) {
                // Inicio de sesión exitoso
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name']; // Ajusta según tu estructura de BD
                
                // Redirigir al dashboard
                header('Location: ?controller=Dashboard&action=index');
                exit();
            } else {
                // Credenciales incorrectas
                $error = "Email o contraseña incorrectos";
                require_once __DIR__ . '/../views/login.php';
            }
        } else {
            // Si no es POST, redirigir al login
            header('Location: ?controller=Login&action=index');
            exit();
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ?controller=Login&action=index');
        exit();
    }
}