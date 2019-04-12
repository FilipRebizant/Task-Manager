<?php

namespace App\Application\Query\User;

use App\Domain\User\User;

class UserView implements UserQueryInterface
{
    /**
     * @param string $userId
     * @return User
     */
    public function getById(string $userId): User
    {
        // TODO: Implement getById() method.
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }
}