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

require_once '../vendor/autoload.php';

$fileLocator = new FileLocator(__DIR__ . '/../config/');
$loader = new YamlFileLoader($fileLocator);
$context = new RequestContext();
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();
$request = Request::createFromGlobals();

$routes = $loader->load('routes.yaml');
try {
    $context->fromRequest($request);

    $matcher = new UrlMatcher($routes, $context);

    $parameters = $matcher->match($context->getPathInfo());

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
