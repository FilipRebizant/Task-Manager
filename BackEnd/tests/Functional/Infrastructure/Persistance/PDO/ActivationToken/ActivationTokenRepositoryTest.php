<?php

namespace App\Tests\Functional\Infrastructure\Persistance\PDO\ActivationToken;

use App\Domain\ActivationToken\ActivationToken;
use App\Domain\ActivationToken\ActivationTokenRepositoryInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Zalas\Injector\PHPUnit\Symfony\TestCase\SymfonyTestContainer;
use Zalas\Injector\PHPUnit\TestCase\ServiceContainerTestCase;

class ActivationTokenRepositoryTest extends TestCase implements ServiceContainerTestCase
{
    use SymfonyTestContainer;

    /** @var ActivationToken */
    private $activationToken;

    /** @var User */
    private $user;

    /**
     * @var UserRepositoryInterface
     * @inject
     */
    private $userRepository;

    /**
     * @var ActivationTokenRepositoryInterface
     * @inject
     */
    private $activationTokenRepository;

    protected function setUp(): void
    {
        $this->user = new User(
            Uuid::uuid4(),
            new Username('usernamefortest'),
            new Email('emailfortest@gmail.com'),
            new Role('ADMIN'),
            []
        );
        $this->activationToken = new ActivationToken(null, $this->user);
    }

    protected function tearDown(): void
    {
        $this->userRepository->delete($this->user->getId()->toString());
    }

    public function testCanSaveAndRetrieveActivationToken()
    {
        $activationTokenId = $this->activationToken->getId()->toString();

        $this->userRepository->create($this->user);
        $this->activationTokenRepository->create($this->activationToken);
        $retrievedActivationToken = $this->activationTokenRepository->getById($activationTokenId);

        $this->assertEquals($this->activationToken->getId()->toString(), $retrievedActivationToken->getId());
    }

    public function testSuccessfulActivateAccount()
    {
        $activationTokenId = $this->activationToken->getId()->toString();
        $this->userRepository->create($this->user);
        $this->activationTokenRepository->create($this->activationToken);

        $this->activationTokenRepository->activateAccount($this->activationToken->getToken());
        $retrievedActivationToken = $this->activationTokenRepository->getById($activationTokenId);

        $this->assertEquals($this->activationToken->getId()->toString(), $retrievedActivationToken->getId());
    }
}
