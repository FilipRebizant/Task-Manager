<?php

namespace App\Application\Contract;

interface CommandBusInterface
{
    public function handle($command): void;
}
