<?php

namespace App\Application\Query\Task;

class TaskView
{
    /** @var string  */
    private $description;

    /** @var string  */
    private $status;

    /** @var int  */
    private $priority;

    /** @var string */
    private $user;

    /**
     * TaskView constructor.
     * @param string $description
     * @param string $status
     * @param int $priority
     * @param string|null $user
     */
    public function __construct(string $description, string $status, int $priority, string $user = null)
    {
        $this->description = $description;
        $this->priority = $priority;
        $this->status = $status;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function priority(): int
    {
        return $this->priority;
    }

    /**
     * @return string
     */
    public function user(): string
    {
        if (!is_null($this->user)){
            return $this->user;
        }

        return "No user assigned";
    }

    public function __toString()
    {
        return $this->description . ' ' . $this->status . $this->user();
    }
}
