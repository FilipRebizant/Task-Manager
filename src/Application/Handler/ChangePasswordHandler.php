<?php

namespace App\Application\Handler;

use App\Application\Command\ChangePasswordCommand;
use App\Domain\User\UserService;

class ChangePasswordHandler
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
     * @param ChangePasswordCommand $command
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function handle(ChangePasswordCommand $command): void
    {
        $this->userService->changePassword($command);
    }
}
