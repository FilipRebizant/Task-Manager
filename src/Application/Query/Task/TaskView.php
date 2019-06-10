<?php

namespace App\Application\Query\Task;

class TaskView
{
    /** @var string */
    private $id;

    /** @var string */
    private $status;

    /** @var int */
    private $priority;

    /** @var string */
    private $user;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $createdAt;

    /** @var string|null */
    private $updatedAt;

    /**
     * TaskView constructor.
     * @param string $id
     * @param string $title
     * @param string $status
     * @param string|null $user
     * @param int $priority
     * @param string $description
     * @param string $createdAt
     * @param string|null $updatedAt
     */
    public function __construct(
        string $id,
        string $title,
        string $status,
        ?string $user,
        int $priority,
        string $description,
        string $createdAt,
        ?string $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->status = $status;
        $this->user = $user;
        $this->priority = $priority;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
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
        if (!is_null($this->user)) {
            return $this->user;
        }

        return "No user assigned";
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
    public function createdAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function updatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function toArray(): array
    {
        $createdAt = new \DateTime($this->createdAt, new \DateTimeZone('UTC'));

        if ($this->updatedAt()) {
            $updatedAt = new \DateTime($this->updatedAt, new \DateTimeZone('UTC'));
            $updatedAt = $updatedAt->format('c');
        } else {
            $updatedAt = $this->updatedAt;
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'status' => $this->status,
            'user' => $this->user,
            'created_at' => $createdAt->format('c'),
            'updated_at' => $updatedAt,
        ];
    }

    public function __toString()
    {
        return $this->description . ' ' . $this->status . $this->user();
    }
}
