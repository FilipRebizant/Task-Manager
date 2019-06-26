<?php

namespace App\Application\Handler;

use App\Application\Command\ActivateAccountCommand;
use App\Domain\User\UserService;

class ActivateAccountHandler
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
     * @param ActivateAccountCommand $command
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function handle(ActivateAccountCommand $command): void
    {
        $this->userService->activateAccount($command);
    }
}
