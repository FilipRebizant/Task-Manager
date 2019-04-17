<?php

namespace App\Tests\Application;

use App\Application\Handler\CreateTaskHandler;
use App\Application\HandlerFactory;
use PHPUnit\Framework\TestCase;

class HandlerFactoryTest extends TestCase
{
    public function testShouldCreateInstanceFromContainer()
    {
        $handlerFactory = new HandlerFactory();
        $container = require_once __DIR__ . '/../../config/dependency_injection.php';
        echo __DIR__;

        $handlerFactory->setDIContainer($container);
        $taskHandlerInstance = $handlerFactory->make(CreateTaskHandler::class);

        $this->assertInstanceOf(CreateTaskHandler::class, $taskHandlerInstance);
    }
}
