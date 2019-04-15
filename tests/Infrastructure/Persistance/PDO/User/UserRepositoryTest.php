<?php

namespace App\Tests\Infrastructure\Persistance\PDO\User;

use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UserRepositoryTest extends TestCase
{
    /** @var UserRepository */
    private $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(new PDOConnector());
    }

    public function testWillThrowExceptionOnInvalidUserId()
    {
        $this->expectException(NotFoundException::class);
        $this->userRepository->delete(Uuid::uuid4()->toString());
    }
}
