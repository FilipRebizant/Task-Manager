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
     * @throws \App\Domain\Task\Exception\InvalidStatusOrderException
     * @throws \App\Domain\Task\Exception\UserNotAssignedException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $status = new Status($command->status());
        $task = $this->taskRepository->getTaskById($command->taskId());
        $task->changeStatus($status);

        $this->taskRepository->changeStatus($command->taskId(), $status);
    }
}
