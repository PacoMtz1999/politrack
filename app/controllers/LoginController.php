<?php
require_once __DIR__ . '/../models/LoginModel.php';

class LoginController {
    public function index() {
        // Iniciar sesión para posibles mensajes de error
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Muestra la vista de login
        require_once __DIR__ . '/../views/login.php';
    }
    
    public function authenticate() {
    // Iniciar sesión al principio
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener y limpiar los datos del formulario
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validaciones básicas
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Por favor, complete todos los campos";
            header('Location: index.php?controller=Login&action=index');
            exit();
        }
        
        // Instanciar el modelo y verificar credenciales
        $model = new LoginModel();
        $user = $model->checkCredentials($email, $password);
        
        // DEPURACIÓN: Ver qué devuelve el modelo
        echo "<pre>";
        echo "Email: " . htmlspecialchars($email) . "\n";
        echo "Password: " . htmlspecialchars($password) . "\n";
        echo "User result: ";
        var_dump($user);
        echo "</pre>";
        // exit(); // Descomenta temporalmente para ver el resultado
        
        if ($user) {
            // Inicio de sesión exitoso
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            
            // Limpiar mensajes de error si existían
            unset($_SESSION['error']);
            
            // DEPURACIÓN: Verificar sesión
            echo "<pre>Sesión después de login: ";
            print_r($_SESSION);
            echo "</pre>";
            
            // Redirigir al dashboard
            header('Location: index.php?controller=Dashboard&action=index');
            exit();
        } else {
            // Credenciales incorrectas
            $_SESSION['error'] = "Email o contraseña incorrectos";
            header('Location: index.php?controller=Login&action=index');
            exit();
        }
    } else {
        // Si no es POST, redirigir al login
        header('Location: index.php?controller=Login&action=index');
        exit();
    }
}
    
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php?controller=Login&action=index');
        exit();
    }
}
?>