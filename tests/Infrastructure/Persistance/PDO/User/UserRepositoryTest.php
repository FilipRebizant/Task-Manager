<?php

namespace App\Tests\Infrastructure\Persistance\PDO\User;

use App\Domain\User\User;
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

    public function testCanSaveAndRetrieveUser() {
        $randomNumber = rand(0, 9999);
        $user = new User(Uuid::uuid4(), 'username_for_testing'. $randomNumber, 'password', 'email_for_testing' . $randomNumber, array());

        $this->userRepository->create($user);
        $foundUser = $this->userQuery->getById($user->getId()->toString());

        $this->assertEquals($user->getId()->toString(), $foundUser->id());
    }
}
