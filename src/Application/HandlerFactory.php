<?php

namespace App\Application;

use DI\Container;

class HandlerFactory
{
    /** @var Container */
    private $container;

    public function __construct()
    {
        if (array_key_exists('container', $GLOBALS)) {
            $this->setDIContainer($GLOBALS['container']);
        }
    }

    /**
     * @param string $handler
     * @return HandlerInterface
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function make(string $handler): HandlerInterface
    {
        return $this->container->make($handler);
    }

    /**
     * @param Container $container
     */
    public function setDIContainer(Container $container): void
    {
        $this->container = $container;
    }
}
