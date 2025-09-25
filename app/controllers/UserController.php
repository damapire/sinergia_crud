<?php
/**
 * Controlador de usuario
 *
 * Este archivo gestiona las acciones relacionadas con el usuario, como el inicio y cierre de sesión.
 * Utiliza JWT para la autenticación segura
 */

require_once __DIR__ . '/../models/UserModel.php'; // Modelo de usuario
require_once __DIR__ . '/../helpers/Validator.php'; // Validación de datos
require_once __DIR__ . '/../../vendor/autoload.php'; // Autoload de Composer para JWT
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * Clase UserController
 *
 * Controlador principal para las acciones de usuario.
 */
class UserController extends App\Core\Controller {

    /**
     * Iniciar sesión de usuario
     *
     * Recibe email y contraseña por POST, valida los datos y genera un token JWT si son correctos.
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validar formato de correo electrónico
            if (!App\Helpers\Validator::email($email)) {
                http_response_code(400);
                echo json_encode(['error' => 'Correo electrónico no válido']);
                exit;
            }

            // Buscar usuario en la base de datos
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);

            // Verificar contraseña
            if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
                $config = require(__DIR__ . '/../../config/config.php');
                $secretKey = $config['jwt_secret'];
                $payload = [
                    'user_id' => $user['id'],
                    'email'   => $user['email'],
                    'rol'     => $user['rol'],
                    'exp'     => time() + 3600 // Expira en 1 hora
                ];
                $jwt = JWT::encode($payload, $secretKey, 'HS256');
                header('Content-Type: application/json');
                echo json_encode(['token' => $jwt]);
                exit;
            } else {
                http_response_code(401);
                echo json_encode(['error' => 'Correo o contraseña incorrectos']);
                exit;
            }
        } else {
            $this->view('user/login');
        }
    }

    /**
     * Cerrar sesión de usuario
     *
     * Destruye la sesión y redirige al login.
     */
    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
