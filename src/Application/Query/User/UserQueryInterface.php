<?php

namespace App\Application\Query\User;

use App\Domain\Security\Symfony\TokenAuth\TokenAuthUser;
use App\Domain\Security\Symfony\SessionAuth\SessionAuthUser;
use App\Infrastructure\Exception\NotFoundException;

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
