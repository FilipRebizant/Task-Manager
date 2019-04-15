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
}
