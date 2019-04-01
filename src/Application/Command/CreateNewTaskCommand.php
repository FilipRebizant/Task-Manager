<?php

namespace App\Application\Command;

class CreateNewTaskCommand
{
    private $status;
    
    private $priority;

    private $description;

    public function __construct(
        string $status,
        int $priority,
        string $description)
    {
        $this->status = $status;
        $this->description = $description;
        $this->priority = $priority;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function priority(): int
    {
        return $this->priority;
    }
}
