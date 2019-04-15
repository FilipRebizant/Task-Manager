<?php

namespace App\Application\Handler;

use App\Application\Command\DeleteTaskCommand;
use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\User\UserRepositoryInterface;

class DeleteUserHandler implements HandlerInterface
{
    /** @var UserRepositoryInterface  */
    private $userRepository;

    /**
     * DeleteUserHandler constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param CommandInterface|DeleteTaskCommand $command
     * @return void
     */
    public function handle(CommandInterface $command): void
    {
        $this->userRepository->delete($command->id());
    }
}
