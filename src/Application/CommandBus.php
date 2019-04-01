<?php

namespace App\Application\Contract;

interface CommandBus
{
    public function handle($command): void;
}
