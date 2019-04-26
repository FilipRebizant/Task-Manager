<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\Exception\InvalidUsernameException;

class Username
{
    /** @var string */
    private $username;

    /**
     * Username constructor.
     * @param string $username
     * @throws InvalidUsernameException
     */
    public function __construct(string $username)
    {
        if (!$this->isValid($username)) {
            throw new InvalidUsernameException();
        }

        $this->username = $username;
    }

    public function __toString()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return bool
     */
    private function isValid(string $username): bool
    {
        return $this->doesUsernameStartsWithLetter($username);
    }

    /**
     * @param string $username
     * @return bool
     */
    private function doesUsernameStartsWithLetter(string $username): bool
    {
        $pattern = '/^[a-zA-Z]/';
        if (preg_match($pattern, $username)) {
            return true;
        }

        return false;
    }
}