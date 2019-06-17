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

    /** @var string|null */
    private $role;

    /** @var string|null */
    private $activationToken;

    /**
     * UserView constructor.
     *
     * @param string $id
     * @param string $username
     * @param string $email
     * @param string $createdAt
     * @param string|null $activationToken
     * @param string|null $role
     * @param array $tasks
     */
    public function __construct(
        string $id,
        string $username,
        string $email,
        string $createdAt,
        ?string $activationToken,
        ?string $role,
        array $tasks
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->createdAt = $createdAt;
        $this->activationToken = $activationToken;
        $this->role = $role;
        $this->tasks = $tasks;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
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

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getActivationToken(): string
    {
        return $this->activationToken;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function toArray(): array
    {
        $date = new \DateTime($this->createdAt);

        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'created_at' => $date->format('c'),
            'activation_token' => $this->activationToken,
            'role' => $this->role,
            'tasks' => $this->tasks,
        ];
    }
}
