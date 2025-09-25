<?php
/**
 * Controlador para la gestión de pacientes (API RESTful)
 */
require_once __DIR__ . '/../models/PacienteModel.php';
require_once __DIR__ . '/../helpers/Auth.php';

class PacienteController {
    // Verifica el token JWT en cada petición
    private function checkAuth() {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';
        if (strpos($authHeader, 'Bearer ') !== 0) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode(['error' => 'Formato de token inválido']);
            exit;
        }
        $token = substr($authHeader, 7);
        $decoded = \App\Helpers\Auth::verifyToken($token);
        if (!$decoded) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido o expirado']);
            exit;
        }
        return $decoded;
    }
    // Obtener todos los pacientes
    public function index() {
        $this->checkAuth();
        $model = new PacienteModel();
        $pacientes = $model->getAll();
        header('Content-Type: application/json');
        echo json_encode($pacientes);
    }

    // Obtener un paciente por ID
    public function show($id) {
        $this->checkAuth();
        $model = new PacienteModel();
        $paciente = $model->getById($id);
        header('Content-Type: application/json');
        echo json_encode($paciente);
    }

    // Crear un nuevo paciente
    public function store() {
        $this->checkAuth();
        $data = json_decode(file_get_contents('php://input'), true);
        $model = new PacienteModel();
        $result = $model->create($data);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    // Actualizar paciente
    public function update($id) {
        $this->checkAuth();
        $data = json_decode(file_get_contents('php://input'), true);
        $model = new PacienteModel();
        $result = $model->update($id, $data);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    // Eliminar paciente
    public function delete($id) {
        $this->checkAuth();
        $model = new PacienteModel();
        $result = $model->delete($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
}
