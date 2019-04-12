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

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): User;
}
