<?php
namespace App\Application;

final class NameInflector implements InflectorInterface
{
    /**
     * @param CommandInterface $command
     * @return string
     */
    public function inflect(CommandInterface $command): string
    {
        return str_replace('Command', 'Handler', get_class($command));
    }
}
