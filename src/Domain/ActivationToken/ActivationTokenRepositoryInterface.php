<?php

namespace App\Domain\ActivationToken;

interface ActivationTokenRepositoryInterface
{
    /**
     * @param ActivationToken $token
     */
    public function create(ActivationToken $token): void;

    /**
     * @param string $id
     * @return ActivationToken
     */
    public function getById(string $id): ActivationToken;

    /**
     * @param ActivationToken $token
     */
    public function activateAccount(ActivationToken $token): void;
}
