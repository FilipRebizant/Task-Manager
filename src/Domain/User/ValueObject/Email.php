<?php

namespace App\Domain\User\ValueObject;

use App\Domain\User\Exception\InvalidEmailException;

class Email
{
    /** @var string */
    private $email;

    /**
     * Username constructor.
     *
     * @param string $email
     * @throws InvalidEmailException
     */
    public function __construct(string $email)
    {
        if (!$this->isValid($email)) {
            throw new InvalidEmailException();
        }

        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return bool
     */
    private function isValid(string $email): bool
    {
        return $this->isEmailValid($email);
    }

    /**
     * @param string $email
     * @return bool
     */
    private function isEmailValid(string $email): bool
    {
        $pattern = '/\b^[a-z][\w]+@[a-z]+\.[a-z]{2,3}\b(.[a-z]{2})?$/';
        if (preg_match($pattern, $email)) {
            return true;
        }

        return false;
    }
}
