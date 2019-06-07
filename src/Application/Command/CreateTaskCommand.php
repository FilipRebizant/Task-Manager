<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class CreateTaskCommand implements CommandInterface
{
    /** @var string */
    private $title;

    /** @var int  */
    private $priority;

    /** @var string  */
    private $description;

    /** @var string */
    private $user;

    /**
     * CreateTaskCommand constructor.
     * @param string $title
     * @param string|null $user
     * @param int $priority
     * @param string $description
     */
    public function __construct(
        string $title,
        ?string $user,
        int $priority,
        string $description
    ) {
        $this->title = $title;
        $this->user = $user;
        $this->priority = $priority;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
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
