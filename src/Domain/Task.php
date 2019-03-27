<?php

namespace Domain;

use Ramsey\Uuid\Uuid;

class Task
{

    /** @var Uuid */
    private $id;

    /** @var User */
    private $user;

     /** @var Status */
    private $status;

    /** @var int */
    private $priority;

    /** @var string */
    private $description;

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
     * @return Status
     */
    public function getStatus(): Status
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
        $this->status::Done;
        
        return $this;
    }

    /**
     * @return Task
     */
    public function setPending(): Task
    {
        $this->status::Pending;

        return $this;
    }

    /**
     * @return Task
     */
    public function setToDo(): Task
    {
        $this->status::Todo;

        return $this;
    }
}
