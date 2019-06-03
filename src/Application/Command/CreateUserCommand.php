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
    private $password1;

    /** @var string */
    private $password2;

    /**
     * CreateUserCommand constructor.
     *
     * @param string $username
     * @param string $email
     * @param string $password1
     * @param string $password2
     */
    public function __construct(string $username, string $email, string $password1, string $password2)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password1 = $password1;
        $this->password2 = $password2;
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
    public function password1(): string
    {
        return $this->password1;
    }

    /**
     * @return string
     */
    public function password2(): string
    {
        return $this->password2;
    }
}
