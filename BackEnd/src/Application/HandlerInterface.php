<?php

namespace App\Application;

interface HandlerInterface
{
    /**
     * @param CommandInterface $command
     * @return void
     */
    public function handle(CommandInterface $command): void;
}
