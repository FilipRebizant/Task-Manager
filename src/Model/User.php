<?php

namespace Model;

use Ramsey\Uuid\Uuid;

class User
{
    /** @var Uuid */
    private $id;

    /** @var string */
    private $userName;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /** @var \DateTime */
    private $createdAt;

    /** @var array */
    private $tasks;


    /**
     * @return UUid
     */
    public function getId(): ? UUid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return User
     */
    public function setUserName(string $userName): User
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt(\DateTime $createdAt): User
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return array
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @param array $tasks
     * @return User
     */
    public function addTask(Task $task): User
    {
        $tasks = $this->tasks;

        if (!in_array($task, $tasks)) {
            array_push($tasks, $task);
            $task->addUser($this);
        }

        return $this;
    }

    /**
     * @param Task $task
     * @return User
     */
    public function removeTask(Task $task): User
    {
        $tasks = $this->tasks;

        if (in_array($task, $tasks)) {
            $index = array_search($task, $tasks);
            array_splice($tasks, $index, 1);
        }

        return $this;
    }
}
