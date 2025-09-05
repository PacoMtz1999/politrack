<?php
require_once __DIR__ . '/../config/database.php';

class LoginModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function checkCredentials($email, $password) {
        $query = "SELECT id, email, username, password FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        
        // Usar bindValue o pasar parámetros en execute (sintaxis PDO)
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar contraseña (asumiendo que está hasheada)
            if (password_verify($password, $user['password'])) {
                // Quitar la password del array antes de devolverlo
                unset($user['password']);
                return $user;
            }
        }
        
        return false;
    }
}
?>