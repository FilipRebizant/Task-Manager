<?php

namespace App\Application\Query\User;

use App\Domain\Security\Symfony\User\SecurityUser;
use App\Domain\User\User;
use App\Infrastructure\Exception\NotFoundException;

interface UserQueryInterface
{
    /**
     * @param string $userId
     * @return User
     */
    public function getById(string $userId): UserView;

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param string $email
     * @return SecurityUser
     * @throws NotFoundException
     */
    public function getSecurityUserByEmail(string $username): SecurityUser;

    /**
     * @param string $username
     * @return SecurityUser
     * @throws NotFoundException
     */
    public function getSecurityUserByUsername(string $username): SecurityUser;
}
