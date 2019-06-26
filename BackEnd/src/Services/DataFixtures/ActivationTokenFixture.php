<?php

namespace App\Services\DataFixtures;

use App\Domain\ActivationToken\ActivationToken;
use App\Infrastructure\Persistance\PDO\ActivationToken\ActivationTokenRepository;

class ActivationTokenFixture extends BaseFixture
{
    /** @var ActivationTokenRepository  */
    private $activationTokenRepository;

    public function __construct(ActivationTokenRepository $activationTokenRepository)
    {
        parent::__construct();

        $this->activationTokenRepository = $activationTokenRepository;
    }

    /**
     * @param array $objects
     * @return ActivationToken
     */
    public function loadActivationToken(array $objects = []): ActivationToken
    {
        $activationToken = new ActivationToken(null, $objects['user']);

        $this->activationTokenRepository->create($activationToken);

        return $activationToken;
    }
}
