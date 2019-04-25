<?php

namespace App\Application\Handler;

use App\Application\Command\CreateUserCommand;
use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Username;
use Ramsey\Uuid\Uuid;

class CreateUserHandler implements HandlerInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * CreateUserHandler constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param CommandInterface $command
     * @throws \App\Domain\User\Exception\InvalidEmailException
     * @throws \App\Domain\User\Exception\InvalidPasswordException
     * @throws \App\Domain\User\Exception\InvalidUsernameException
     */
    public function handle(CommandInterface $command): void
    {
        $user = new User(
            Uuid::uuid4(),
            new Username($command->username()),
            new Password($command->password()),
            new Email($command->email()),
            array()
        );

        $this->userRepository->create($user);
    }
}
