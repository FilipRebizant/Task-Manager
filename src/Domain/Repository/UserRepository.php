<?php

namespace App\Domain\Repository;

use App\Domain\User;

interface UserRepository
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
