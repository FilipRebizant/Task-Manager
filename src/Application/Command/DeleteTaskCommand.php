<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class DeleteTaskCommand implements CommandInterface
{
    /** @var int  */
    private $id;

    /**
     * DeleteTaskCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }
}
