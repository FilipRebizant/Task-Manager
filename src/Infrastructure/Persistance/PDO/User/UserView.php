<?php

namespace App\Infrastructure\Persistance\PDO\User;

use App\Application\Query\User\UserQueryInterface;

class UserView implements UserQueryInterface
{

    /**
     * @param string $userId
     * @return TaskView
     */
    public function getById(string $userId): UserView
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