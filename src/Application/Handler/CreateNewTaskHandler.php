<?php

namespace App\Application\Handler;

use App\Application\Command\CreateNewTaskCommand;
use App\Domain\Description;
use App\Domain\Priority;
use App\Domain\Status;
use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;

final class CreateNewTaskHandler
{
    /** @var TaskRepositoryInterface  */
    private $taskRepository;

    /**
     * CreateNewTaskHandler constructor.
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param CreateNewTaskCommand $command
     * @throws \Exception
     */
    public function handle(CreateNewTaskCommand $command): void
    {
        $task = new Task(
            new Status($command->status()),
            null,
            new Priority($command->priority()),
            new Description($command->description())
        );

        $this->taskRepository->create($task);
    }
}
