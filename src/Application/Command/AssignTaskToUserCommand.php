<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class AssignTaskToUserCommand implements CommandInterface
{
    /** @var string */
    private $task;

    /** @var string */
    private $user;

    /**
     * AssignUserToTaskCommand constructor.
     * @param string $task
     * @param string $user
     */
    public function __construct(
        string $task,
        string $user
    ) {
        $this->user = $user;
        $this->task = $task;
    }

    /**
     * @return string
     */
    public function user(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function task(): string
    {
        return $this->task;
    }
}
