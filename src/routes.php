<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\RegistrationHandler;
use App\NisSearchHandler;

class Router
{
    private static $routes = [];
    private static $postRoutes = [];
    // Método estático para adicionar rotas
    public static function get($path, $callback)
    {
        self::$routes[$path] = $callback;
    }

    public static function post($path, $callback)
    {
        self::$postRoutes[$path] = $callback;
    }

    public static function run()
    {
        $path = $_SERVER['REQUEST_URI'];

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset(self::$routes[$path])) {
            $callback = self::$routes[$path];
            call_user_func($callback);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset(self::$postRoutes[$path])) {
            $callback = self::$postRoutes[$path];
            call_user_func($callback);
        } else {
            echo "Página não encontrada";
        }
    }
}

Router::get('/', function () {
    include '../public/inicial.php';
});

Router::get('/cadastrar', function () {
    include '../public/registration.php';
});

Router::post('/cadastrar', function () {
    $handler = new RegistrationHandler();
    $handler->handleRequest();
});

Router::get('/pesquisar-nis', function () {
   include '../public/search.php';
});
Router::post('/pesquisar-nis', function () {
    $handler = new NisSearchHandler();
    $handler->handleRequest();
});
