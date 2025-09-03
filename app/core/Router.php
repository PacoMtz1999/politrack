<?php
class Router {
    public function run() {
        $controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']).'Controller' : 'LoginController';
        $action = $_GET['action'] ?? 'index';

        // Ruta del controlador
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                if (method_exists($controller, $action)) {
                    $controller->$action();
                } else {
                    echo "Método $action no encontrado en el controlador $controllerName.";
                }
            } else {
                echo "Clase $controllerName no encontrada.";
            }
        } else {
            echo "Controlador $controllerName no encontrado.";
        }
    }
}
