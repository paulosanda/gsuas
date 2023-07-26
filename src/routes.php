<?php

class Router
{
    private static $routes = [];

    // Método estático para adicionar rotas
    public static function get($path, $callback)
    {
        self::$routes[$path] = $callback;
    }

    // Método estático para executar o roteamento
    public static function run()
    {
        $path = $_SERVER['REQUEST_URI'];

        if (isset(self::$routes[$path])) {
            $callback = self::$routes[$path];
            call_user_func($callback);
        } else {
            echo "Página não encontrada";
        }
    }
}

// Defina as rotas do seu projeto aqui
Router::get('/', function () {
    echo "Página inicial";
});

Router::get('/about', function () {
    echo "Sobre nós";
});

Router::get('/contact', function () {
    echo "Contato";
});
