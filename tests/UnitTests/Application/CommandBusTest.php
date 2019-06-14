<?php

namespace App\Tests\Application;

use App\Application\Command\CreateUserCommand;
use App\Application\CommandBus;
use App\Application\Handler\CreateUserHandler;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommandBusTest extends WebTestCase
{
    static protected $container;

    /** @var CommandBus */
    private $commandBus;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
        $this->commandBus = $this->container->get('command_bus');
    }

    public function testCanGetHandlerNameFromCommand()
    {
        $command = new CreateUserCommand('username', 'email@email.com', 'ADMIN');
        $handlerName = $this->commandBus->getHandlerName($command);

        $this->assertEquals(CreateUserHandler::class, $handlerName);
    }
}
