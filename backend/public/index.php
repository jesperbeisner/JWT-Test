<?php

declare(strict_types=1);

use App\Controller;
use App\JsonResponse;

require __DIR__ . '/../vendor/autoload.php';

$result = null;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute(['GET', 'POST'], '/auth', [Controller::class, 'authAction']);
    $r->addRoute('GET', '/users', [Controller::class, 'usersAction']);
    $r->addRoute('GET', '/logout', [Controller::class, 'logoutAction']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        $result = new JsonResponse(['message' => 'Page not found'], 404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        $result = new JsonResponse(['message' => 'Method not allowed'], 405);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $controllerName = $handler[0];
        $actionName = $handler[1];

        $controller = new $controllerName();
        $result = $controller->$actionName();
        break;
}

if ($result === null) {
    $result = new JsonResponse(['message' => 'Something went wrong! o.O'], 500);
}

$result->send();
die;
