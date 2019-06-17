<?php

namespace App\Tests\Unit\Application;

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

        $container = self::$kernel->getContainer();
        $this->commandBus = $container->get('command_bus');
    }

    public function testCanGetHandlerNameFromCommand()
    {
        $command = new CreateUserCommand('username', 'email@email.com', 'ADMIN');
        $handlerName = $this->commandBus->getHandlerName($command);

        $this->assertEquals(CreateUserHandler::class, $handlerName);
    }
}
