<?php
require __DIR__.'/../vendor/autoload.php';

$container = new \Illuminate\Container\Container();
require_once __DIR__ . "/../config/dependencies.php";

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$dispatcher = FastRoute\simpleDispatcher(
    function (FastRoute\RouteCollector $r) {
        require_once __DIR__ . "/../config/routes.php";
    }
);


$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
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

        return $container->make($handler)
            ->setContainer($container)
            ->setParams($request->query)
            ->response();
        break;
}
