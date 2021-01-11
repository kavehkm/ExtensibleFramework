<?php
use Blog\BlogRoutes;
use EF\EntryPoint;


try {
    // autoloader
    include __DIR__ . '/../includes/autoload.php';


    $route = $_GET['route'] ?? 'posts/list';
    $routes = new BlogRoutes();
    $method = $_SERVER['REQUEST_METHOD'];

    // create entry point and go...
    $entryPoint = new EntryPoint($route, $routes, $method);
    $entryPoint->run();

} catch (Exception $e) {
    $title = 'error';
    $output = $e->getMessage();
    include __DIR__ . '/../templates/layout.html.php';
}