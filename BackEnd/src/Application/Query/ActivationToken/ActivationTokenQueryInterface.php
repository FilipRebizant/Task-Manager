<?php

namespace App\Application\Query\ActivationToken;

interface ActivationTokenQueryInterface
{
    /**
     * @param string $activationTokenId
     * @return ActivationTokenView
     */
    public function getById(string $activationTokenId): ActivationTokenView;
}
