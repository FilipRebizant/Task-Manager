<?php

namespace App\Infrastructure\Persistance\PDO\ActivationToken;

use App\Domain\ActivationToken\ActivationToken;
use App\Domain\ActivationToken\ActivationTokenRepositoryInterface;

class ActivationTokenRepositoryRepository implements ActivationTokenRepositoryInterface
{

    /**
     * @param ActivationToken $token
     */
    public function create(ActivationToken $token): void
    {
        // TODO: Implement create() method.
    }

    /**
     * @param string $id
     * @return ActivationToken
     */
    public function getById(string $id): ActivationToken
    {
        // TODO: Implement getById() method.
    }

    /**
     * @param ActivationToken $token
     */
    public function activateAccount(ActivationToken $token): void
    {
        // TODO: Implement activateAccount() method.
    }
}
