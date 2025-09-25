<?php

/**
 * Clase Database
 *
 * Se encarga de gestionar la conexión a la base de datos usando PDO.
 */
class Database {
    private $pdo;

    /**
     * Constructor
     * Establece la conexión a la base de datos al crear la instancia.
     */
    public function __construct() {
        $config = require(__DIR__ . '/../../config/config.php');
        $host    = $config['db_host'];
        $db      = $config['db_name'];
        $user    = $config['db_user'];
        $pass    = $config['db_pass'];
        $charset = isset($config['db_charset']) ? $config['db_charset'] : 'utf8';
        $dsn     = "mysql:host={$host};dbname={$db};charset={$charset}";
        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die('Error de conexión PDO: ' . $e->getMessage());
        }
    }

    /**
     * Obtener la instancia de conexión PDO
     *
     */
    public function getConnection() {
        return $this->pdo;
    }
}
