<?php

namespace App\Application;

interface CommandBusInterface
{
    public function handle(CommandInterface $command): void;
}
