<?php

namespace App\Application\Handler;

use App\Application\Command\CreateUserCommand;
use App\Domain\User\UserService;

class CreateUserHandler
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
     * @param CreateUserCommand $command
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Domain\User\Exception\EmailAlreadyExistsException
     * @throws \App\Domain\User\Exception\UserAlreadyExistsException
     */
    public function handle(CreateUserCommand $command): void
    {
        $this->userService->createUser($command);
    }
}
