<?php

namespace App\Services\EmailService;

interface ProviderInterface
{
    /**
     * @param array $data
     * @return bool
     */
    public function sendActivationEmail(array $data): bool;
}
