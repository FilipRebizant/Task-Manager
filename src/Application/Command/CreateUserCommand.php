<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class CreateUserCommand implements CommandInterface
{
    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /**
     * CreateUserCommand constructor.
     *
     * @param string $username
     * @param string $email
     */
    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
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
}
