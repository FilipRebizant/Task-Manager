<?php

namespace App\Tests\Unit\Application;

use App\Application\Handler\CreateUserHandler;
use App\Application\HandlerFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HandlerFactoryTest extends WebTestCase
{
    static protected $container;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    public function testCan()
    {
        $handlerFactory = new HandlerFactory($this::$container);
        $handlerName = CreateUserHandler::class;

        $instance = $handlerFactory->make($handlerName);

        $this->assertInstanceOf(CreateUserHandler::class, $instance);
    }
}
