<?php

namespace App\Domain\User;


interface UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function create(User $user);

    /**
     * @param User $user
     */
    public function delete(User $user);
}
