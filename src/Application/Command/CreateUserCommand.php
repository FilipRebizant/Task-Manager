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
    private $password;

    /**
     * CreateUserCommand constructor.
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function __construct(string $username, string $password, string $email)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
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
}
