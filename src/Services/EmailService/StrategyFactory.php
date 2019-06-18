<?php

namespace App\Services\EmailService;

use App\Services\EmailService\Exception\ProviderException;
use App\Services\EmailService\Provider\SendGrid\SendGrid;

class StrategyFactory
{
    const DEFAULT_STRATEGY = 'sendgrid';

    /** @var SendGrid */
    private $sendGrid;

    public function __construct(SendGrid $sendGrid)
    {
        $this->sendGrid = $sendGrid;
    }

    /**
     * @param string $name
     * @return ProviderInterface
     * @throws ProviderException
     */
    public function getStrategy(string $name = self::DEFAULT_STRATEGY): ProviderInterface
    {
        switch (strtolower($name)){
            case SendGrid::NAME:
                return $this->sendGrid;
            default:
                throw new ProviderException(sprintf('Provider: %s was not found'), $name);
        }
    }
}
