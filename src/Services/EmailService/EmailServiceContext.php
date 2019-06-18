<?php

namespace App\Services\EmailService;

class EmailServiceContext
{
    /** @var ProviderInterface */
    private $provider;

    /**
     * EmailServiceContext constructor.
     *
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return ProviderInterface
     */
    public function getProvider(): ProviderInterface
    {
        return $this->provider;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function sendActivationEmail(array $data): bool
    {
        return $this->provider->sendActivationEmail($data);
    }
}
