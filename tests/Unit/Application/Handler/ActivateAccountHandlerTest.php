<?php

namespace App\Tests\Unit\Application\Handler;

    use App\Application\Command\ActivateAccountCommand;
    use App\Application\CommandBus;
    use App\Application\Handler\ActivateAccountHandler;
    use PHPUnit\Framework\TestCase;
    use Zalas\Injector\PHPUnit\Symfony\TestCase\SymfonyTestContainer;
    use Zalas\Injector\PHPUnit\TestCase\ServiceContainerTestCase;

class ActivateAccountHandlerTest extends TestCase implements ServiceContainerTestCase
{
    use SymfonyTestContainer;

    /**
     * @var ActivateAccountHandler
     * @inject
     */
    private $handler;

    /**
     * @var CommandBus
     * @inject
     */
    private $commandBus;

    public function testWillTriggerActivateAccountMethod()
    {
        $handlerMock = $this->getMockBuilder(ActivateAccountHandler::class)->disableOriginalConstructor()->getMock();
        $handlerMock->expects($this->once())->method('handle');
//
        $command = new ActivateAccountCommand('token', 'password', 'password');
        $commandBusMock = $this->getMockBuilder(CommandBus::class)->disableOriginalConstructor()->getMock();
//        $commandBusMock->handle($command);
//        $commandBusMock->
        $commandBusMock->expects($this->once())->method('handle');
        $this->commandBus->handle($command);
//        $this->handler
    }
}