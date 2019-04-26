<?php

namespace App\Tests\Infrastructure\Persistance\PDO\User;

use App\Domain\User\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\User\UserQuery;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UserRepositoryTest extends TestCase
{
    /** @var UserRepository */
    private $userRepository;

    /** @var UserQuery */
    private $userQuery;

    /** @var PDOConnector */
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDOConnector();
        $this->userRepository = new UserRepository($this->pdo);
        $this->userQuery = new UserQuery($this->pdo);
    }

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
     * @throws \App\Domain\User\Exception\InvalidEmailException
     * @throws \App\Domain\User\Exception\InvalidPasswordException
     * @throws \App\Domain\User\Exception\InvalidUsernameException
     */
    public function testCanSaveAndRetrieveUser() {
        $randomNumber = rand(0, 9999);
        $user = new User(
            Uuid::uuid4(),
            new Username('username_for_testing'. $randomNumber),
            new Password('password'),
            new Email('email_for_testing' . $randomNumber . '@gmail.com'),
            array()
        );

        $this->userRepository->create($user);
        $foundUser = $this->userQuery->getById($user->getId()->toString());

        $this->assertEquals($user->getId()->toString(), $foundUser->id());
    }


    public function testWillThrowNotFoundException()
    {
        $this->expectException(NotFoundException::class);

        $this->userRepository->getUserByUsername("UnExisting user");
    }
}
