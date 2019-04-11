<?php

namespace App\Application\Handler;

use App\Application\Command\CreateNewTaskCommand;
use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use App\Domain\Task\ValueObject\Title;
use App\Infrastructure\Persistance\PDO\TaskRepository;

class CreateNewTaskHandler implements HandlerInterface
{
    /** @var TaskRepositoryInterface  */
    private $taskRepository;

    /**
     * CreateNewTaskHandler constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param CommandInterface|CreateNewTaskCommand $command
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function handle(CommandInterface $command): void
    {
        if (!is_null($command->user())) {
            $user = $command->user();
        }

        $task = new Task(
            new Title($command->title()),
            new Status($command->status()),
            $user,
            new Priority($command->priority()),
            new Description($command->description())
        );

        $this->taskRepository->create($task);
    }
}
