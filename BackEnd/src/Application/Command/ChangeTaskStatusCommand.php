<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class ChangeTaskStatusCommand implements CommandInterface
{
    /** @var string */
    private $taskId;

    /** @var string */
    private $status;

    /**
     * ChangeTaskStatusCommand constructor.
     *
     * @param string $taskId
     * @param string $status
     */
    public function __construct(string $taskId, string $status)
    {
        $this->taskId = $taskId;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function taskId(): string
    {
        return $this->taskId;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }
}
