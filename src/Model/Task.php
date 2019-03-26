<?php

namespace Model;

class Task
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $users;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var string
     */
    private $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return Task
     */
    public function addUser(User $user): Task
    {
        $users = $this->users;

        if (!in_array($user, $users)) {
            array_push($users, $user);
            $user->addTask($this);
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
}
