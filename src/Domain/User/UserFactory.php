<?php

namespace App\Domain\User;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use Ramsey\Uuid\Uuid;

class UserFactory
{
    /**
     * @param array $data
     * @return User
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function create(array $data): User
    {
        return new User(
            Uuid::fromString($data['id']),
            new Username($data['username']),
            new Email($data['email']),
            new Role($data['role']),
            array_key_exists('tasks', $data) ? $data['tasks']: []
        );
    }
}
