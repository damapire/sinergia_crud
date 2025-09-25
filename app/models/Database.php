<?php

class Database {
    private $pdo;

    public function __construct() {
        $config = require(__DIR__ . '/../../config/config.php');
        $host = $config['db_host'];
        $db = $config['db_name'];
        $user = $config['db_user'];
        $pass = $config['db_pass'];
        $charset = isset($config['db_charset']) ? $config['db_charset'] : 'utf8';
        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die('Error de conexión PDO: ' . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
