<?php
    require_once 'app/core/Controller.php';
    require_once 'app/core/Database.php';

    $uri = $_GET['url'] ?? 'home';
    require_once 'routes/routes.php';
    
    if (array_key_exists($uri, $routes)) {
        $controllerName = $routes[$uri]['controller'];
        $method         = $routes[$uri]['method'];
        require_once "app/controllers/{$controllerName}.php";
        $controller = new $controllerName();
        $controller->$method();
    } else {
        echo "<h1>404 - Página não encontrada!</h1>";
    }