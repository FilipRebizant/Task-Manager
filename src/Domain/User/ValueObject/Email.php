<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\Exception\InvalidArgumentException;

class Email
{
    /** @var string */
    private $email;

    /**
     * Email constructor.
     *
     * @param string $email
     * @throws InvalidArgumentException
     */
    public function __construct(string $email)
    {
        if (!$this->isValid($email)) {
            throw new InvalidArgumentException("Provided email address is invalid");
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
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}
