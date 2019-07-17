<?php

namespace App\Application;

use Symfony\Component\DependencyInjection\ContainerInterface;

class HandlerFactory
{
    /** @var ContainerInterface */
    private $container;

    /**
     * HandlerFactory constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $handler
     */
    public function make(string $handler)
    {
        return $this->container->get($handler);
    }
}
