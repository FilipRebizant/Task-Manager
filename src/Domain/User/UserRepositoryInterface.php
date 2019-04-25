<?php

namespace App\Domain\User;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Username;

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
     * @param Username $username
     * @return User
     */
    public function getUserByUsername(Username $username): User;

    /**
     * @param Email $email
     * @return User
     */
    public function getUserByEmail(Email $email): User;
}
