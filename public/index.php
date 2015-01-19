<?php
require '../vendor/autoload.php';

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$dispatcher = FastRoute\simpleDispatcher(
    function (FastRoute\RouteCollector $r) {
        require_once "../config/routes.php";
    }
);

$config = new \Iono\Container\Configure();
$compiler = new \Iono\Container\Compiler(
    new \Iono\Container\Annotation\AnnotationManager(),
    $config->set(require dirname(__FILE__) . '/../config/config.php')
);
$compiler->setForceCompile(false);
$compilerContainer = new \Iono\Container\Container($compiler);
$container = $compilerContainer->register();

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
            ->setParams($request->query)->response();
        break;
}
