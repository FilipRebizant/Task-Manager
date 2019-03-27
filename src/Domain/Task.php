<?php declare(strict_types=1);

namespace App\Domain;

use Ramsey\Uuid\Uuid;

class Task
{
    /** @var Uuid */
    private $id;

    /** @var User */
    private $user;

     /** @var int */
    private $status;

    /** @var int */
    private $priority;

    /** @var string */
    private $description;

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var \DateTimeImmutable */
    private $updatedAt;


    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getAssignedUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Task
     */
    public function assignUser(User $user): Task
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param User $user
     * @return Task
     */
    public function unassignUser(User $user): Task
    {
        if ($this->user === $user) {
            $this->user = null;
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * @return Task
     */
    public function setStatus(Status $status): Task
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return Task
     */
    public function setPriority(int $priority): Task
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Task
     */
    public function setDescription(string $description): Task
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Task
     */
    public function setDone(): Task
    {
        $this->status = Status::Done;

        return $this;
    }

    /**
     * @return Task
     */
    public function setPending(): Task
    {
        $this->status = Status::Pending;

        return $this;
    }

    /**
     * @return Task
     */
    public function setToDo(): Task
    {
        $this->status = Status::Todo;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     * @return Task
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): Task
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     * @return Task
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): Task
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
