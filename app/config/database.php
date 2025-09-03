<?php
class Database {
    public static function connect() {
        $pdo = new PDO("mysql:host=localhost;port=3325;dbname=politrack", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}