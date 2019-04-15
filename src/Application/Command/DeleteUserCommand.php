<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class DeleteUserCommand implements CommandInterface
{
    /** @var string  */
    private $id;

    /**
     * DeleteUserCommand constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}
