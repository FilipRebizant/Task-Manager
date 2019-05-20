<?php

declare(strict_types=1);

namespace App\Application\Query\User;

class UserView
{
    /** @var string */
    private $id;

    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /** @var string */
    private $createdAt;

    /** @var array */
    private $tasks;

    /**
     * UserView constructor.
     * @param string $id
     * @param string $username
     * @param string $email
     * @param string $createdAt
     * @param array $tasks
     */
    public function __construct(string $id, string $username, string $email, string $createdAt, array $tasks)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->createdAt = $createdAt;
        $this->tasks = $tasks;
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
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }
}
