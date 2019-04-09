<?php

namespace App\Application;

use App\Infrastructure\Persistance\PDO\TaskRepository;

final class CommandBus implements CommandBusInterface
{
    /** @var NameInflector */
    private $inflector;

    private $handlerName;

    private $handler;

    private $handlerFactory;

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
        $this->getHandlerName($command);
        $this->buildHandler($this->handlerName);
        $this->handler->handle($command);
    }

    /**
     * @param CommandInterface $command
     */
    private function getHandlerName(CommandInterface $command)
    {
        $this->handlerName = $this->inflector->inflect($command);
    }

    /**
     * @param string $handler
     */
    private function buildHandler(string $handler)
    {
        $this->handler = $this->handlerFactory->make($handler);
    }
}
