<?php

namespace App\Application;

class HandlerFactory
{
    private $container;

    public function __construct()
    {
        $this->container = $GLOBALS['container'];
    }

    public function make($handler): HandlerInterface
    {
        return $this->handler = $this->container->make($handler);
    }
}