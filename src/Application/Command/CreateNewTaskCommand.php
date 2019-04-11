<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class CreateNewTaskCommand implements CommandInterface
{
    /** @var string */
    private $title;

    /** @var string  */
    private $status;

    /** @var int  */
    private $priority;

    /** @var string  */
    private $description;

    /** @var string */
    private $user;

    /**
     * CreateNewTaskCommand constructor.
     * @param string $title
     * @param string $status
     * @param int $priority
     * @param string $description
     */
    public function __construct(
        string $title,
        string $status,
        int $priority,
        string $description
    )
    {
        $this->title = $title;
        $this->status = $status;
        $this->description = $description;
        $this->priority = $priority;
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
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function user(): ?string
    {
        return $this->user;
    }
}
