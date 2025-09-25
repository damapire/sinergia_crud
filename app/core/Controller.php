<?php
namespace App\Core;

/**
 * Clase base para los controladores
 *
 * Proporciona métodos para cargar modelos y vistas de forma sencilla.
 */
class Controller {

    /**
     * Cargar un modelo
     *
     */
    public function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    /**
     * Cargar una vista
     *
     */
    public function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}
