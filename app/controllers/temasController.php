<?php
class TemasController {
    public function index() {
        require_once __DIR__ . '../models/temas.php';
        $modelo = new Temas();
        $temas = $modelo->getAll();

        require_once __DIR__ . '/../views/temas/index.php';
    }
}
