<?php

namespace App\Application\Handler;

use App\Application\Command\CreateUserCommand;
use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
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
     * @param CommandInterface|CreateUserCommand $command
     * @return void
     */
    public function handle(CommandInterface $command): void
    {
        $user = new User(
            Uuid::uuid4(),
            $command->username(),
            $command->password(),
            $command->email(),
            array()
        );

        $this->userRepository->create($user);
    }
}
