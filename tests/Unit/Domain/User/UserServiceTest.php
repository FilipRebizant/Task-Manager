<?php

namespace App\Tests\Domain\User;

use App\Application\Command\ChangePasswordCommand;
use App\Domain\User\User;
use App\Domain\User\UserService;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserServiceTest extends WebTestCase
{
    /** @var UserRepository */
    private $userRepository;

    /** @var UserService */
    private $userService;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = self::$kernel->getContainer();
        $this->userQuery = $container->get('userQuery');
        $this->userRepository = $container->get('userRepository');

        $uuid = Uuid::uuid4();
        $this->user = new User(
            $uuid,
            new Username('username1'),
            new Email('username1@gmail.com'),
            new Role('ADMIN'),
            []
        );
        $this->userService = $container->get('userService');
//        $this->userRepository->create($this->user, null);
    }

    public function testWillGetInvalidArgumentException()
    {
//        $userService = new UserService();
        $command = new ChangePasswordCommand(Uuid::uuid4()->toString(), 'password2', 'password2');
        $this->expectException(NotFoundException::class);
        $this->userService->changePassword($command);
    }
}
