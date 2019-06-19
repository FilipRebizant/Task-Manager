<?php

namespace App\Domain\ActivationToken;

class ActivationTokenFactory
{
    /**
     * @param array $data
     * @return ActivationToken
     */
    public function create(array $data): ActivationToken
    {
        $activationToken = new ActivationToken(
            null,
            $data['user']
        );

        return $activationToken;
    }
}
