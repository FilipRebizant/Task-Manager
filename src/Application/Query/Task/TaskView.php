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

    /** @var string */
    private $title;

    /** @var string */
    private $created_at;

    /** @var string|null */
    private $updated_at;

    /**
     * TaskView constructor.
     * @param string $title
     * @param string $status
     * @param string|null $user
     * @param int $priority
     * @param string $description
     * @param string $created_at
     * @param string|null $updated_at
     */
    public function __construct(
        string $title,
        string $status,
        string $user = null,
        int $priority,
        string $description,
        string $created_at,
        string $updated_at = null
    )
    {
        $this->description = $description;
        $this->priority = $priority;
        $this->status = $status;
        $this->user = $user;
        $this->title = $title;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
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

    public function created_at(): string
    {
        return $this->created_at;
    }

    public function __toString()
    {
        return $this->description . ' ' . $this->status . $this->user();
    }
}
