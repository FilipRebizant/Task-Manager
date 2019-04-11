<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Task\Task;
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

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var array */
    private $tasks;

    /**
     * @return UUid
     */
    public function getId(): UUid
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
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     * @return User
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): User
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return array
     */
    public function getAssignedTasks(): array
    {
        if (is_null($this->tasks)) {
            return array();
        }

        return $this->tasks;
    }

    /**
     * @param array $tasks
     * @return User
     */
    public function assignTask(Task $task): User
    {
        $tasks = $this->getAssignedTasks();

        if (!in_array($task, $tasks)) {
            array_push($tasks, $task);
            $this->tasks = $tasks;
            $task->assignUser($this);
        }

        return $this;
    }

    /**
     * @param Task $task
     * @return User
     */
    public function unassignTask(Task $task): User
    {
        $tasks = $this->getAssignedTasks();

        if (in_array($task, $tasks)) {
            $index = array_search($task, $tasks);
            array_splice($tasks, $index, 1);
            $task->unassignUser($this);
            $this->tasks = $tasks;
        }

        return $this;
    }
}
