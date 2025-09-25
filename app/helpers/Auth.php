<?php
namespace App\Helpers;

require_once __DIR__ . '/../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Clase Auth
 *
 * Utiliza métodos para la autenticación basada en JWT.
 */
class Auth {

    /**
     * Verificar y decodificar un token JWT
     *
     */
    public static function verifyToken($token) {
        $config = require(__DIR__ . '/../../config/config.php');
        $secretKey = $config['jwt_secret'];
        try {
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            return false;
        }
    }
}
