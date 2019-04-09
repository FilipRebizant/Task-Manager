<?php

namespace App\Application\Command;

class DeleteTaskCommand
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
