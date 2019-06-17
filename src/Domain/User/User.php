<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Task\Task;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use Ramsey\Uuid\Uuid;

class User
{
    /** @var Uuid */
    private $id;

    /** @var Username */
    private $userName;

    /** @var Email */
    private $email;

    /** @var Password|null */
    private $password;

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var Task[] */
    private $tasks;

    /** @var Role */
    private $role;

    /**
     * User constructor.
     *
     * @param Uuid $uuid
     * @param Username $username
     * @param Email $email
     * @param Role $role
     * @param array $tasks
     * @throws \Exception
     */
    public function __construct(Uuid $uuid, Username $username, Email $email, Role $role, array $tasks)
    {
        $this->id = $uuid;
        $this->userName = $username;
        $this->email = $email;
        $this->createdAt = new \DateTimeImmutable('now');
        $this->role = $role;
        $this->tasks = $tasks;
    }

    /**
     * @return UUid
     */
    public function getId(): UUid
    {
        return $this->id;
    }

    /**
     * @return Username
     */
    public function getUserName(): Username
    {
        return $this->userName;
    }

    /**
     * @param Username $userName
     * @return User
     */
    public function setUserName(Username $userName): User
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     * @return User
     */
    public function setEmail(Email $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Password|null
     */
    public function getPassword(): ?Password
    {
        return $this->password;
    }

    /**
     * @param Password|null $password
     * @return User
     */
    public function setPassword(?Password $password): User
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
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    /**
     * @return Task[]
     */
    public function getAssignedTasks(): array
    {
        if (!$this->tasks) {
            return array();
        }

        return $this->tasks;
    }

    /**
     * @param Task $task
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
