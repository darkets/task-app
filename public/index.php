<?php

use App\RedirectResponse;
use App\ViewResponse;
use App\Controllers\TaskController;
//use App\RedirectResponse;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/../.env');

$loader = new FilesystemLoader(__DIR__ . '/../views/');
$twig = new Environment($loader);

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [TaskController::class, 'index']);
    $r->addRoute('GET', '/create', [TaskController::class, 'create']);
    $r->addRoute('POST', '/', [TaskController::class, 'store']);
    $r->addRoute('POST', '/delete/{id:\d+}', [TaskController::class, 'delete']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = $handler;

        $response = (new $controller())->{$method}(...array_values($vars));

        switch (true) {
            case $response instanceof ViewResponse:
                echo $twig->render($response->getViewName() . '.twig',$response->getData());
                break;

            case $response instanceof RedirectResponse:
                header('Location: ' . $response->getLocation());
                break;

            default:
                break;
        }
        break;
}