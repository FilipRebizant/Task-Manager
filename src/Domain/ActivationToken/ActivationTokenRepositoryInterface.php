<?php

namespace App\Domain\ActivationToken;

use App\Infrastructure\Exception\NotFoundException;

interface ActivationTokenRepositoryInterface
{
    /**
     * @param ActivationToken $token
     */
    public function create(ActivationToken $token): void;

    /**
     * @param string $id
     * @return ActivationToken
     * @throws NotFoundException
     */
    public function getById(string $id): ActivationToken;

    /**
     * @param string $token
     * @throws NotFoundException
     */
    public function activateAccount(string $token): void;
}
