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
3. Configura la base de datos en `config/config.php` y ejecuta el script `docs/script_db.sql`.
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
    PacienteController.php
    UserController.php
  models/
    Database.php
    PacienteModel.php
    UserModel.php
  helpers/
    Auth.php
    Validator.php
  core/
    App.php
    Controller.php
  views/
    user/login.php
    pacientes/pacientes_list.php
config/
  config.php
public/
  index.php
  router.php
docs/
  EER_Diagram.pdf   # Diagrama entidad-relación
  script_db.sql     # Script de la base de datos
tests/
  PacienteModelTest.php
vendor/
  autoload.php
```

## Documentación y recursos
- Diagrama entidad-relación: [`docs/EER_Diagram.pdf`](docs/EER_Diagram.pdf)
- Script de base de datos: [`docs/script_db.sql`](docs/script_db.sql)
- Pruebas unitarias: [`tests/PacienteModelTest.php`](tests/PacienteModelTest.php)

## Notas
- El flujo de login y listado de pacientes está protegido con JWT.
- Para desarrollo, puedes usar Postman para probar los endpoints protegidos.
