# Sinergia CRUD

API RESTful en PHP para la gestión de pacientes y usuarios, con autenticación JWT y arquitectura MVC.

## Características
- CRUD completo para pacientes
- Autenticación de usuarios con JWT
- Validación y sanitización de datos
- Rutas amigables y enrutador central
- Pruebas unitarias con PHPUnit

## Instalación
1. Clona el repositorio:
   ```
   git clone https://github.com/damapire/sinergia_crud.git
   ```
2. Instala dependencias con Composer:
   ```
   composer install
   ```
3. Configura la base de datos en `config/config.php` y ejecuta el script `script_db.sql`.
4. Inicia el servidor embebido de PHP:
   ```
   php -S localhost:3000 -t public public/router.php
   ```

## Endpoints principales

### Autenticación
- **POST** `/login` — Iniciar sesión y obtener token JWT

### Pacientes
- **GET** `/pacientes` — Listar todos los pacientes
- **GET** `/pacientes/{id}` — Obtener paciente por ID
- **POST** `/pacientes` — Crear paciente
- **PUT** `/pacientes/{id}` — Actualizar paciente
- **DELETE** `/pacientes/{id}` — Eliminar paciente

> Todos los endpoints de pacientes requieren el header:
> `Authorization: Bearer <token>`

## Pruebas
- Ejecuta las pruebas unitarias con:
  ```
  .\vendor\bin\phpunit tests/PacienteModelTest.php
  ```

## Estructura del proyecto
```
app/
  controllers/
  models/
  helpers/
  views/
  core/
config/
public/
vendor/
tests/
```

## Autor
- damapire

## Licencia
