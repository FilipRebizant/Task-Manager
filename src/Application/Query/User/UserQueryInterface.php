<?php

namespace App\Application\Query\User;

use App\Domain\User\User;

interface UserQueryInterface
{
    /**
     * @param string $userId
     * @return User
     */
    public function getById(string $userId): User;

    /**
     * @return array
     */
    public function getAll(): array;
}