<?php

namespace App\Domain\User;

use App\Infrastructure\Exception\NotFoundException;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function create(User $user): void;

    /**
     * @param string $user
     */
    public function delete(string $user): void;

    /**
     * @param string $username
     * @return User
     * @throws NotFoundException
     */
    public function getByUsername(string $username): User;

    /**
     * @param string $username
     * @return bool
     * @throws NotFoundException
     */
    public function checkIfUsernameExists(string $username): bool;

    /**
     * @param string $username
     * @return bool
     * @throws NotFoundException
     */
    public function checkIfEmailExists(string $username): bool;

    /**
     * @param string $userId
     * @param string $password
     * @throws NotFoundException
     */
    public function changePassword(string $userId, string $password): void;

    /**
     * @param string $activationToken
     * @throws NotFoundException
     */
    public function activateNewUser(string $activationToken, $password): void;
}
