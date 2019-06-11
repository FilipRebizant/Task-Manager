<?php

namespace App\Application\Handler;

use App\Application\Command\CreatePasswordCommand;
use App\Domain\User\UserService;

class CreatePasswordHandler
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
     * @param CreatePasswordCommand $command
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function handle(CreatePasswordCommand $command): void
    {
        $this->userService->createPassword($command);
    }
}
