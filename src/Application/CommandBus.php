<?php

namespace App\Application;

use App\Application\Contract\CommandBusInterface;

class CommandBus implements CommandBusInterface
{
    private $handlers = [];

    /**
     * @param string $commandClass
     * @param $handler
     */
    public function registerHandler(string $commandClass, $handler): void
    {
        $this->handlers[$commandClass] = $handler;
    }

    /**
     * @param $command
     */
    public function handle($command): void
    {
        $this->handlers[get_class($command)]->handle($command);
    }
}
