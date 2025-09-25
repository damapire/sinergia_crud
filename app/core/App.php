<?php
namespace App\Core;

class App {
    public function __construct() {
        $url = $this->parseUrl();

        // Rutas para pacientes
        if (isset($url[0]) && strtolower($url[0]) === 'pacientes') {
            require_once __DIR__ . '/../controllers/PacienteController.php';
            $controller = new \PacienteController();

            // /pacientes/{id}
            if (isset($url[1]) && is_numeric($url[1])) {
                $id = $url[1];
                switch ($_SERVER['REQUEST_METHOD']) {
                    case 'GET':
                        $controller->show($id);
                        break;
                    case 'PUT':
                        $controller->update($id);
                        break;
                    case 'DELETE':
                        $controller->delete($id);
                        break;
                    default:
                        http_response_code(405);
                        echo json_encode(['error' => 'Método no permitido']);
                }
                return;
            }

            // /pacientes
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $controller->index();
                    break;
                case 'POST':
                    $controller->store();
                    break;
                default:
                    http_response_code(405);
                    echo json_encode(['error' => 'Método no permitido']);
            }
            return;
        }

        // Rutas para usuario
        if (isset($url[0]) && strtolower($url[0]) === 'login') {
            require_once __DIR__ . '/../controllers/UserController.php';
            $controller = new \UserController();
            $controller->login();
            return;
        }
        if (isset($url[0]) && strtolower($url[0]) === 'logout') {
            require_once __DIR__ . '/../controllers/UserController.php';
            $controller = new \UserController();
            $controller->logout();
            return;
        }

        // Si no coincide ninguna ruta, error 404
        http_response_code(404);
        echo json_encode(['error' => 'Ruta no encontrada']);
    }

    public function parseUrl() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $path = preg_replace('#^' . preg_quote(dirname($scriptName), '#') . '#', '', $requestUri);
        $path = preg_replace('#\?.*$#', '', $path);
        $path = trim($path, '/');
        return $path ? explode('/', filter_var($path, FILTER_SANITIZE_URL)) : [];
    }
}
