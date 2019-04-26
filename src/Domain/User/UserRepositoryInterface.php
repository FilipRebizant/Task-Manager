<?php

namespace App\Domain\User;

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
     */
    public function getUserByUsername(string $username): User;

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User;
}
