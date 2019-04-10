<?php

namespace App\Application;

final class CommandBus implements CommandBusInterface
{
    /** @var NameInflector */
    private $inflector;

    /** @var string */
    private $handlerName;

    /** @var HandlerInterface */
    private $handler;

    /** @var HandlerFactory  */
    private $handlerFactory;

    /**
     * CommandBus constructor.
     * @param NameInflector $inflector
     * @param HandlerFactory $handlerFactory
     */
    public function __construct(NameInflector $inflector, HandlerFactory $handlerFactory)
    {
        $this->inflector = $inflector;
        $this->handlerFactory = $handlerFactory;
    }

    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command): void
    {
        $this->setHandlerName($command);
        $this->buildHandler($this->handlerName);

        $this->handler->handle($command);
    }

    /**
     * @param CommandInterface $command
     */
    private function setHandlerName(CommandInterface $command): void
    {
        $this->handlerName = $this->inflector->inflect($command);
    }

    /**
     * @param string $handler
     */
    private function buildHandler(string $handler): void
    {
        $this->handler = $this->handlerFactory->make($handler);
    }
}
