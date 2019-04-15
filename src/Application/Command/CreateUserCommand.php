<?php

namespace App\Application\Command;

class CreateUserCommand
{
    /** @var string */
    private $id;

    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /** @var array */
    private $tasks;

    /**
     * CreateUserCommand constructor.
     * @param string $id
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $tasks
     */
    public function __construct(string $id, string $username, string $email, string $password, array $tasks)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
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
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function tasks(): array
    {
        return $this->tasks;
    }
}
