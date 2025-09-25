<?php
require_once __DIR__ . '/Database.php';

class UserModel extends App\Core\Model {
    private $db;
    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
