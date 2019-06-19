<?php

namespace App\Application\Query\User;

use App\Infrastructure\Exception\NotFoundException;
use App\Services\Symfony\Security\SessionAuth\SessionAuthUser;

interface UserQueryInterface
{
    /**
     * @param string $userId
     * @return UserView
     * @throws NotFoundException
     */
    public function getById(string $userId): UserView;

    /**
     * @param string $username
     * @return UserView
     * @throws NotFoundException
     */
    public function getByUsername(string $username): UserView;

    /**
     * @return array
     * @throws NotFoundException
     */
    public function getAll(): array;

    /**
     * @param string $email
     * @return SessionAuthUser
     * @throws NotFoundException
     */
    public function getSessionAuthUserByEmail(string $email): SessionAuthUser;

    /**
     * @param string $username
     * @return SessionAuthUser
     * @throws NotFoundException
     */
    public function getSessionAuthUserByUsername(string $username): SessionAuthUser;
}
