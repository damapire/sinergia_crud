SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- -----------------------------------------------------
-- Schema sinergia
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sinergia` DEFAULT CHARACTER SET utf8 ;


-- -----------------------------------------------------
-- Table `sinergia`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sinergia`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `rol` VARCHAR(45) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `correo_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;

USE `sinergia` ;

-- -----------------------------------------------------
-- Table `sinergia`.`departamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sinergia`.`departamentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `sinergia`.`genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sinergia`.`genero` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `sinergia`.`municipios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sinergia`.`municipios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `departamento_id` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `idx_municipio_departamento` (`departamento_id` ASC) VISIBLE,
  CONSTRAINT `fk_municipio_departamento_id`
    FOREIGN KEY (`departamento_id`)
    REFERENCES `sinergia`.`departamentos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `sinergia`.`paciente_foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sinergia`.`paciente_foto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ruta` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `sinergia`.`tipos_documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sinergia`.`tipos_documento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `sinergia`.`paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sinergia`.`paciente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo_documento_id` INT NOT NULL,
  `numero_documento` VARCHAR(45) NOT NULL,
  `nombre1` VARCHAR(45) NOT NULL,
  `nombre2` VARCHAR(45) NULL DEFAULT NULL,
  `apellido1` VARCHAR(45) NOT NULL,
  `apellido2` VARCHAR(45) NULL DEFAULT NULL,
  `genero_id` INT NOT NULL,
  `departamento_id` INT NOT NULL,
  `municipio_id` INT NOT NULL,
  `correo` VARCHAR(60) NOT NULL,
  `paciente_foto_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_paciente_departamento_id` (`departamento_id` ASC) VISIBLE,
  INDEX `fk_paciente_foto_id` (`paciente_foto_id` ASC) VISIBLE,
  INDEX `fk_paciente_genero_id` (`genero_id` ASC) VISIBLE,
  INDEX `fk_paciente_municipio_id` (`municipio_id` ASC) VISIBLE,
  INDEX `fk_paciente_tipo_documento_id` (`tipo_documento_id` ASC) VISIBLE,
  CONSTRAINT `fk_paciente_departamento_id`
    FOREIGN KEY (`departamento_id`)
    REFERENCES `sinergia`.`departamentos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paciente_foto_id`
    FOREIGN KEY (`paciente_foto_id`)
    REFERENCES `sinergia`.`paciente_foto` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paciente_genero_id`
    FOREIGN KEY (`genero_id`)
    REFERENCES `sinergia`.`genero` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paciente_municipio_id`
    FOREIGN KEY (`municipio_id`)
    REFERENCES `sinergia`.`municipios` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_paciente_tipo_documento_id`
    FOREIGN KEY (`tipo_documento_id`)
    REFERENCES `sinergia`.`tipos_documento` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;







-- ============================================================================
-- SEEDERS 
-- ============================================================================

INSERT INTO `departamentos` (`nombre`) VALUES
  ('Tolima'),
  ('Cundinamarca'),
  ('Antioquia'),
  ('Valle del Cauca'),
  ('Santander');


INSERT INTO `municipios` (`departamento_id`, `nombre`) VALUES
  (1, 'Ibagué'), (1, 'Espinal'),
  (2, 'Bogotá'), (2, 'Soacha'),
  (3, 'Medellín'), (3, 'Bello'),
  (4, 'Cali'), (4, 'Palmira'),
  (5, 'Bucaramanga'), (5, 'Floridablanca');


INSERT INTO `tipos_documento` (`nombre`) VALUES
  ('CC'), ('TI');


INSERT INTO `genero` (`nombre`) VALUES
  ('Masculino'), ('Femenino');


INSERT INTO `users` (`nombre`, `email`, `password`, `rol`) VALUES
  ('Administrador', 'admin@sihos.local', '1234567890', 'admin');


INSERT INTO `paciente`
(`tipo_documento_id`, `numero_documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`,
 `genero_id`, `departamento_id`, `municipio_id`, `correo`)
VALUES
  (1, '100000001', 'Juan',  'Carlos', 'Pérez',  'Gómez', 1, 1, 1, 'juan.perez@example.com'),
  (1, '100000002', 'Ana',   NULL,     'García', 'López', 2, 2, 3, 'ana.garcia@example.com'),
  (2, '200000003', 'Luis',  'Alberto','Ramírez','Díaz',  1, 3, 5, 'luis.ramirez@example.com'),
  (1, '100000004', 'María', 'Elena',  'Suárez', 'Ríos',  2, 4, 7, 'maria.suarez@example.com'),
  (2, '200000005', 'Pedro', NULL,     'Torres', 'Mejía', 1, 5, 9, 'pedro.torres@example.com');