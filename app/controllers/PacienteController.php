<?php
/**
 * Controlador para la gestión de pacientes (API RESTful)
 */
require_once __DIR__ . '/../models/PacienteModel.php';
require_once __DIR__ . '/../helpers/Auth.php';

class PacienteController extends App\Core\Controller {
    // Obtener todos los pacientes
    public function index() {
        $model = new PacienteModel();
        $pacientes = $model->getAll();
        header('Content-Type: application/json');
        echo json_encode($pacientes);
    }

    // Obtener un paciente por ID
    public function show($id) {
        $model = new PacienteModel();
        $paciente = $model->getById($id);
        header('Content-Type: application/json');
        echo json_encode($paciente);
    }

    // Crear un nuevo paciente
    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        $model = new PacienteModel();
        $result = $model->create($data);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    // Actualizar paciente
    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $model = new PacienteModel();
        $result = $model->update($id, $data);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }

    // Eliminar paciente
    public function delete($id) {
        $model = new PacienteModel();
        $result = $model->delete($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => $result]);
    }
}
