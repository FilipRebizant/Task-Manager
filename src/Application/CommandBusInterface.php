<?php

namespace App\Application;

interface CommandBusInterface
{
    public function handle($command): void;
}
