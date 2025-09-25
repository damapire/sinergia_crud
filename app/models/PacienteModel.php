<?php
/**
 * Modelo para la gestión de pacientes
 */
require_once __DIR__ . '/Database.php';

class PacienteModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    // Obtener todos los pacientes
    public function getAll() {
        $sql = 'SELECT * FROM paciente';
        error_log('Consulta SQL: ' . $sql);
        $stmt = $this->db->query($sql);
        $result = $stmt->fetchAll();
        error_log('Resultado: ' . print_r($result, true));
        return $result;
    }

    // Obtener paciente por ID
    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM paciente WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Crear paciente
    public function create($data) {
        // Sanitización y validación
        $tipo_documento_id = filter_var($data['tipo_documento_id'], FILTER_VALIDATE_INT);
        $numero_documento  = trim(strip_tags($data['numero_documento']));
        $nombre1           = trim(strip_tags($data['nombre1']));
        $nombre2           = trim(strip_tags($data['nombre2']));
        $apellido1         = trim(strip_tags($data['apellido1']));
        $apellido2         = trim(strip_tags($data['apellido2']));
        $genero_id         = filter_var($data['genero_id'], FILTER_VALIDATE_INT);
        $departamento_id   = filter_var($data['departamento_id'], FILTER_VALIDATE_INT);
        $municipio_id      = filter_var($data['municipio_id'], FILTER_VALIDATE_INT);
        $correo            = filter_var($data['correo'], FILTER_VALIDATE_EMAIL);

        if (!$tipo_documento_id || !$genero_id || !$departamento_id || !$municipio_id || !$correo) {
            return false;
        }

        $stmt = $this->db->prepare(
            'INSERT INTO paciente 
            (tipo_documento_id, numero_documento, nombre1, nombre2, apellido1, apellido2, genero_id, departamento_id, municipio_id, correo) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );

        return $stmt->execute([
            $tipo_documento_id,
            $numero_documento,
            $nombre1,
            $nombre2,
            $apellido1,
            $apellido2,
            $genero_id,
            $departamento_id,
            $municipio_id,
            $correo
        ]);
    }

    // Actualizar paciente
    public function update($id, $data) {
        // Sanitización y validación
        $tipo_documento_id = filter_var($data['tipo_documento_id'], FILTER_VALIDATE_INT);
        $numero_documento  = trim(strip_tags($data['numero_documento']));
        $nombre1           = trim(strip_tags($data['nombre1']));
        $nombre2           = trim(strip_tags($data['nombre2']));
        $apellido1         = trim(strip_tags($data['apellido1']));
        $apellido2         = trim(strip_tags($data['apellido2']));
        $genero_id         = filter_var($data['genero_id'], FILTER_VALIDATE_INT);
        $departamento_id   = filter_var($data['departamento_id'], FILTER_VALIDATE_INT);
        $municipio_id      = filter_var($data['municipio_id'], FILTER_VALIDATE_INT);
        $correo            = filter_var($data['correo'], FILTER_VALIDATE_EMAIL);

        if (!$tipo_documento_id || !$genero_id || !$departamento_id || !$municipio_id || !$correo) {
            return false;
        }

        $stmt = $this->db->prepare(
            'UPDATE paciente 
            SET tipo_documento_id=?, numero_documento=?, nombre1=?, nombre2=?, apellido1=?, apellido2=?, genero_id=?, departamento_id=?, municipio_id=?, correo=? 
            WHERE id=?'
        );

        return $stmt->execute([
            $tipo_documento_id,
            $numero_documento,
            $nombre1,
            $nombre2,
            $apellido1,
            $apellido2,
            $genero_id,
            $departamento_id,
            $municipio_id,
            $correo,
            $id
        ]);
    }

    // Eliminar paciente
    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM paciente WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
