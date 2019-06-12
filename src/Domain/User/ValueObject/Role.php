<?php

namespace App\Domain\User\ValueObject;

use App\Domain\Exception\InvalidArgumentException;

class Role
{
    /**
     * @var array
     */
    private $validRoles = [
        'ADMIN',
        'USER',
    ];

    /** @var string */
    private $role;

    /**
     * Role constructor.
     *
     * @param string $role
     * @throws InvalidArgumentException
     */
    public function __construct(string $role)
    {
        if (!in_array($role, $this->validRoles)) {
            throw new InvalidArgumentException("This is not a valid status.");
        }

        $this->role = $role;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->role;
    }
}
