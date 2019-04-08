<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

//$controller = $controllerResolver->getController($request);

//$arguments = $argumentResolver->getArguments($request, $controller);

//$response = call_user_func_array($controller, $arguments);

try{
    require_once '../vendor/autoload.php';

    $container = require_once __DIR__ . '/../config/bootstrap.php';

    $fileLocator = new FileLocator(__DIR__ . '/../config/');
    $loader = new YamlFileLoader($fileLocator);
    $context = new RequestContext();
    $controllerResolver = new ControllerResolver();
    $argumentResolver = new ArgumentResolver();
    $request = Request::createFromGlobals();

    $routes = $loader->load('routes.yaml');

    $context->fromRequest($request);

    $matcher = new UrlMatcher($routes, $context);

    $request->attributes->add($matcher->match($request->getPathInfo()));

    $response = $container->call($request->attributes->get(['_controller'][0]));
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found', 404);
} catch (\Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();
