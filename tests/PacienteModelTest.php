<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../app/models/PacienteModel.php';

class PacienteModelTest extends TestCase {
    private $model;

    protected function setUp(): void {
        $this->model = new PacienteModel();
    }

    public function testCreatePacienteConDatosValidos() {
        $data = [
            'tipo_documento_id' => 1,
            'numero_documento' => '123456',
            'nombre1' => 'Juan',
            'nombre2' => 'Carlos',
            'apellido1' => 'Pérez',
            'apellido2' => 'Gómez',
            'genero_id' => 1,
            'departamento_id' => 1,
            'municipio_id' => 1,
            'correo' => 'juan@example.com'
        ];
        $result = $this->model->create($data);
        $this->assertTrue($result);
    }

    public function testCreatePacienteConCorreoInvalido() {
        $data = [
            'tipo_documento_id' => 1,
            'numero_documento' => '123456',
            'nombre1' => 'Juan',
            'nombre2' => 'Carlos',
            'apellido1' => 'Pérez',
            'apellido2' => 'Gómez',
            'genero_id' => 1,
            'departamento_id' => 1,
            'municipio_id' => 1,
            'correo' => 'correo-invalido'
        ];
        $result = $this->model->create($data);
        $this->assertFalse($result);
    }

    public function testUpdatePacienteConDatosValidos() {
        $data = [
            'tipo_documento_id' => 1,
            'numero_documento' => '654321',
            'nombre1' => 'Ana',
            'nombre2' => 'Maria',
            'apellido1' => 'Lopez',
            'apellido2' => 'Diaz',
            'genero_id' => 2,
            'departamento_id' => 2,
            'municipio_id' => 2,
            'correo' => 'ana@example.com'
        ];
        $result = $this->model->update(1, $data); // Suponiendo que el paciente con ID 1 existe
        $this->assertTrue($result);
    }

    public function testUpdatePacienteConCorreoInvalido() {
        $data = [
            'tipo_documento_id' => 1,
            'numero_documento' => '654321',
            'nombre1' => 'Ana',
            'nombre2' => 'Maria',
            'apellido1' => 'Lopez',
            'apellido2' => 'Diaz',
            'genero_id' => 2,
            'departamento_id' => 2,
            'municipio_id' => 2,
            'correo' => 'correo-invalido'
        ];
        $result = $this->model->update(1, $data);
        $this->assertFalse($result);
    }
}
