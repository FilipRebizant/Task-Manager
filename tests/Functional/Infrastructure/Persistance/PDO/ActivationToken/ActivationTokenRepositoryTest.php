<?php

namespace App\Tests\Functional\Infrastructure\Persistance\PDO\ActivationToken;

use App\Domain\ActivationToken\ActivationTokenRepositoryInterface;
use App\Infrastructure\Persistance\PDO\ActivationToken\ActivationTokenRepositoryRepository;
use PHPUnit\Framework\TestCase;
use Zalas\Injector\PHPUnit\Symfony\TestCase\SymfonyTestContainer;
use Zalas\Injector\PHPUnit\TestCase\ServiceContainerTestCase;

class ActivationTokenRepositoryTest extends TestCase implements ServiceContainerTestCase
{
    use SymfonyTestContainer;

    private $activationToken;

    /**
     * @var ActivationTokenRepositoryInterface
     * @inject
     */
    private $activationTokenRepository;

    protected function setUp(): void
    {

//        $this->activationToken = new ActivationToken(
//            null,


//        );
    }

    public function testCanSaveActivationToken()
    {
        $this->assertInstanceOf(ActivationTokenRepositoryRepository::class, $this->activationTokenRepository);
    }
}
