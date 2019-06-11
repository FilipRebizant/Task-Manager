<?php

namespace App\Application\Handler;

use App\Application\Command\AssignTaskToUserCommand;
use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\Task\TaskService;

class AssignTaskToUserHandler implements HandlerInterface
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
     * @param AssignTaskToUserCommand|CommandInterface $command
     * @throws \App\Domain\User\Exception\UserAlreadyExistsException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $this->taskService->assignUserToTask($command);
    }
}
