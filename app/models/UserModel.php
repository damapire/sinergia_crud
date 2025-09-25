<?php
/**
 * Modelo de usuario
 *
 * Este archivo contiene la lógica para interactuar con la tabla 'users' de la base de datos.
 */

require_once __DIR__ . '/Database.php'; // conexión a la base de datos

/**
 * Clase UserModel
 *
 * Permite obtener información de los usuarios desde la base de datos.
 */
class UserModel {
    private $db;

    /**
     * Constructor
     * Inicializa la conexión a la base de datos.
     */
    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    /**
     * Buscar usuario por correo electrónico
     *
     * @param string $email Correo electrónico del usuario
     * @return array|false datos del usuario si existe, false si no existe
     */
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
