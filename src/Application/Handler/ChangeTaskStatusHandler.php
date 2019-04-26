<?php

namespace App\Application\Handler;

use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\Task\TaskRepositoryInterface;
use App\Domain\Task\ValueObject\Status;

class ChangeTaskStatusHandler implements HandlerInterface
{
    /** @var TaskRepositoryInterface  */
    private $taskRepository;

    /**
     * ChangeTaskStatusHandler constructor.
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param CommandInterface $command
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function handle(CommandInterface $command): void
    {
        $status = new Status($command->status());
        $task = $this->taskRepository->getTaskByTaskId($command->taskId());
        $task->changeStatus($status);

        $this->taskRepository->changeStatus($command->taskId(), $status);
    }
}
