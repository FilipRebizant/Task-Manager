<?php

use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Loader\Configurator\RouteConfigurator;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use \Symfony\Component\Routing\RequestContext;
use \Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Interfaces\Web\Controller\TaskController;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\Loader\ClosureLoader;
use Symfony\Component\HttpKernel\Config\FileLocator;


require_once '../vendor/autoload.php';

//    $routesClosure = require_once '../config/routes.php';
//    $fileLocator = new \Symfony\Component\Config\FileLocator(__DIR__ . '/config');
//    $loader = new PhpFileLoader($fileLocator);
//    $routes = $loader->load('routes.php');
//    var_dump($routes);

try {
//    $loader = new PhpFileLoader();

    $createTaskRoute = new Route(
        'createTask',
        array('_controller' => [new TaskController(), 'createTask'])
    );

    $homeRoot = new Route(
        '/',
        array('_controller' => [new TaskController(), 'home'])
    );

    $routes = new RouteCollection();
    $routes->add('createTask', $createTaskRoute);
    $routes->add('home', $homeRoot);

    $context = new RequestContext();
    $request = Request::createFromGlobals();
    $context->fromRequest($request);


    $matcher = new UrlMatcher($routes, $context);

    $parameters = $matcher->match($context->getPathInfo());

    $controllerResolver = new ControllerResolver();
    $argumentResolver = new ArgumentResolver();

    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);


} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found', 404);
} catch (\Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();
