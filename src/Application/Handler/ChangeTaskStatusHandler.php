<?php

namespace App\Application\Handler;

use App\Application\Command\ChangeTaskStatusCommand;
use App\Domain\Task\TaskRepositoryInterface;
use App\Domain\Task\ValueObject\Status;

class ChangeTaskStatusHandler
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
     * @param ChangeTaskStatusCommand $command
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Domain\Task\Exception\InvalidStatusOrderException
     * @throws \App\Domain\Task\Exception\UserNotAssignedException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function handle(ChangeTaskStatusCommand $command): void
    {
        $status = new Status($command->status());
        $task = $this->taskRepository->getTaskById($command->taskId());
        $task->changeStatus($status);

        $this->taskRepository->changeStatus($command->taskId(), $status);
    }
}
