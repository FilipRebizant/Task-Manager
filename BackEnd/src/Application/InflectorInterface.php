<?php
namespace App\Application;

interface InflectorInterface
{
    /**
     * @param CommandInterface $command
     * @return string
     */
    public function inflect(CommandInterface $command): string;
}
