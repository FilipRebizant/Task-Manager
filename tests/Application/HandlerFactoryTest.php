<?php

namespace App\Tests\Application;

use App\Application\Handler\CreateNewTaskHandler;
use App\Application\HandlerFactory;
use PHPUnit\Framework\TestCase;

class HandlerFactoryTest extends TestCase
{
    public function testShouldCreateInstanceFromContainer()
    {
        $handlerFactory = new HandlerFactory();
        $container = require_once __DIR__ . '/../../config/dependency_injection.php';

        $handlerFactory->setDIContainer($container);
        $taskHandlerInstance = $handlerFactory->make(CreateNewTaskHandler::class);

        $this->assertInstanceOf(CreateNewTaskHandler::class, $taskHandlerInstance);
    }
}
