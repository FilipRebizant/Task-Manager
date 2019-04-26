<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\User\Exception\InvalidPasswordException;

class Password
{
    /** @var int */
    private const PASSWORD_LENGTH = 8;

    /** @var string */
    private $password;

    /**
     * Password constructor.
     * @param string $password
     * @throws InvalidPasswordException
     */
    public function __construct(string $password)
    {
        if (!$this->isValid($password)) {
            throw new InvalidPasswordException();
        }

        $this->password = $password;
    }

    public function __toString()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return bool
     */
    private function isValid(string $password): bool
    {
        return $this->isPasswordLongEnough($password);
    }

    /**
     * @param string $password
     * @return bool
     */
    private function isPasswordLongEnough(string $password): bool
    {
        if (strlen($password) >= self::PASSWORD_LENGTH) {
            return true;
        }

        return false;
    }
}
