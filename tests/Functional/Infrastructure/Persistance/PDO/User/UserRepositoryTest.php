<?php

namespace App\Tests\Functional\Infrastructure\Persistance\PDO\User;

use App\Application\Query\User\UserQueryInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Zalas\Injector\PHPUnit\Symfony\TestCase\SymfonyTestContainer;
use Zalas\Injector\PHPUnit\TestCase\ServiceContainerTestCase;

class UserRepositoryTest extends TestCase implements ServiceContainerTestCase
{
    use SymfonyTestContainer;

    /**
     * @var UserRepositoryInterface
     * @inject
     */
    private $userRepository;

    /**
     * @var UserQueryInterface
     * @inject
     */
    private $userQuery;

    /**
     * @throws NotFoundException
     */
    public function testWillThrowExceptionOnInvalidUserId()
    {
        $this->expectException(NotFoundException::class);
        $this->userRepository->delete(Uuid::uuid4()->toString());
    }

    /**
     * @throws NotFoundException
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function testCanSaveAndRetrieveUser() {
        $randomNumber = rand(0, 9999);
        $user = new User(
            Uuid::uuid4(),
            new Username('username_for_testing'. $randomNumber),
            new Email('email_for_testing' . $randomNumber . '@gmail.com'),
            new Role('ADMIN'),
            array()
        );
        $token = Uuid::uuid4()->toString();

        $this->userRepository->create($user, $token);
        $foundUser = $this->userQuery->getById($user->getId()->toString());

        $this->assertEquals($user->getId()->toString(), $foundUser->getId());
        $this->userRepository->delete($user->getId());
    }

    /**
     * @throws NotFoundException
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function testWillThrowNotFoundException()
    {
        $this->expectException(NotFoundException::class);

        $this->userRepository->getByUsername("UnExisting user");
    }

    public function testWillThrowNotFoundExceptionWhenTokenIsExpired()
    {
        $this->expectException(NotFoundException::class);

        $this->userRepository->activateNewUser('expired token', 'password');
    }

    public function testWillThrowNotFoundExceptionWhenEmailDoesNotExist()
    {
        $this->expectException(NotFoundException::class);

        $this->userRepository->checkIfEmailExists('nonexistingemail@notexisingemail.com');
    }
}
