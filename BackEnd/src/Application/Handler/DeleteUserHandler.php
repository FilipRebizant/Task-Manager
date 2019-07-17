<?php

namespace App\Application\Handler;

use App\Application\Command\DeleteUserCommand;
use App\Domain\User\UserRepositoryInterface;

class DeleteUserHandler
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
     * @param DeleteUserCommand $command
     * @return void
     */
    public function handle(DeleteUserCommand $command): void
    {
        $this->userRepository->delete($command->id());
    }
}
