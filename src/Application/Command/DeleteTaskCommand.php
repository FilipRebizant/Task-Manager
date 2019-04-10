<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class DeleteTaskCommand implements CommandInterface
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
