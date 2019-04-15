<?php

namespace App\Application\Handler;

use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\Task\TaskRepositoryInterface;
use App\Infrastructure\Persistance\PDO\Task\TaskRepository;

class AssignUserToTaskHandler implements HandlerInterface
{

    /** @var TaskRepositoryInterface  */
    private $taskRepository;

    /**
     * CreateTaskHandler constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param CommandInterface $command
     * @return void
     */
    public function handle(CommandInterface $command): void
    {
        $this->taskRepository->assignUserToTask(
            $command->task(),
            $command->user(),
        );
    }
}
