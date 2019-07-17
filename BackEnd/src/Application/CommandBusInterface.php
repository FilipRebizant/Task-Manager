<?php

namespace App\Application;

interface CommandBusInterface
{
    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command): void;

    /**
     * @param CommandInterface $command
     * @return string
     */
    public function getHandlerName(CommandInterface $command): string;
}
