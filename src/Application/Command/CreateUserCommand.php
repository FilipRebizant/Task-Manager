<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class CreateUserCommand implements CommandInterface
{
    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /** @var string */
    private $role;

    /**
     * CreateUserCommand constructor.
     *
     * @param string $username
     * @param string $email
     * @param string $role
     */
    public function __construct(string $username, string $email, string $role)
    {
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
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
    public function role(): string
    {
        return $this->role;
    }
}
