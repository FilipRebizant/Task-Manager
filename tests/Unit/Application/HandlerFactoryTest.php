<?php

namespace App\Tests\Unit\Application;

use App\Application\Handler\CreateUserHandler;
use App\Application\HandlerFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HandlerFactoryTest extends WebTestCase
{
     /** @var HandlerFactory */
    private $handlerFactory;

    protected function setUp(): void
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();
        $this->handlerFactory = new HandlerFactory($container);
    }

    public function testCan()
    {
        $handlerName = CreateUserHandler::class;

        $instance = $this->handlerFactory->make($handlerName);

        $this->assertInstanceOf(CreateUserHandler::class, $instance);
    }
}
