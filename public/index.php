<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

require_once '../vendor/autoload.php';

    $container = require_once __DIR__ . '/../config/dependency_injection.php';

    $fileLocator = new FileLocator(__DIR__ . '/../config/');
    $loader = new YamlFileLoader($fileLocator);
    $routes = $loader->load('routes.yaml');

    $request = Request::createFromGlobals();
    $context = new RequestContext();

    $context->fromRequest($request);

    $matcher = new UrlMatcher($routes, $context);

    $request->attributes->add($matcher->match($request->getPathInfo()));

    $method = $request->attributes->get(['_controller'][0]);

    $response = $container->call($method, ['request' => $request]);
try{
} catch (ResourceNotFoundException $e) {
    $response = new Response('Not found', 404);
} catch (\Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();
