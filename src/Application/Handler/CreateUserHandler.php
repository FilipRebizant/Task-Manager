<?php

namespace App\Application\Handler;

use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\User\UserService;

class CreateUserHandler implements HandlerInterface
{
    /** @var UserService */
    private $userService;

    /**
     * CreateUserHandler constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param CommandInterface $command
     * @throws \App\Domain\User\Exception\EmailAlreadyExistsException
     * @throws \App\Domain\User\Exception\InvalidEmailException
     * @throws \App\Domain\User\Exception\InvalidPasswordException
     * @throws \App\Domain\User\Exception\InvalidUsernameException
     * @throws \App\Domain\User\Exception\UserAlreadyExistsException
     */
    public function handle(CommandInterface $command): void
    {
        $this->userService->createUser($command);
    }
}
