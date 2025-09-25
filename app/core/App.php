<?php
namespace App\Core;

/**
 * Clase principal del sistema MVC
 *
 * Se encarga de recibir la URL, identificar el controlador y método a ejecutar,
 * y pasar los parámetros necesarios. Permite rutas simples como /login y /logout.
 */
class App {
    /**
     * Nombre del controlador por defecto
     * Método por defecto
     * Parámetros de la URL
     */
    protected $controller = 'UserController';
    protected $method = 'login';
    protected $params = [];

    /**
     * Constructor
     * analiza la URL y ejecuta el controlador y método correspondiente.
     */
    public function __construct() {
        $url = $this->parseUrl();
        $simpleRoutes = [
            'login'  => ['UserController', 'login'],
            'logout' => ['UserController', 'logout'],
        ];


        // Si la ruta es simple, asigna el controlador y método
        if (isset($url[0]) && isset($simpleRoutes[strtolower($url[0])])) {
            $this->controller = $simpleRoutes[strtolower($url[0])][0];
            $this->method     = $simpleRoutes[strtolower($url[0])][1];
            unset($url[0]);
        } else if (isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;


        // Si hay método en la URL, lo asigna
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }
        $this->params = $url ? array_values($url) : [];
        // Ejecuta el método del controlador con los parámetros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Procesa la URL recibida
     *
     */
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [$this->controller];
    }
}
