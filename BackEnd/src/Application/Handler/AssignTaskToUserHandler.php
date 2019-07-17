<?php

namespace App\Application\Handler;

use App\Application\Command\AssignTaskToUserCommand;
use App\Domain\Task\TaskService;

class AssignTaskToUserHandler
{
    /** @var TaskService */
    private $taskService;

    /**
     * AssignTaskToUserHandler constructor.

     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @param AssignTaskToUserCommand $command
     * @throws \App\Domain\User\Exception\UserAlreadyExistsException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function handle(AssignTaskToUserCommand $command): void
    {
        $this->taskService->assignUserToTask($command);
    }
}
