<?php

namespace App\Application\Handler;

use App\Application\Command\DeleteTaskCommand;
use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\Task\TaskRepositoryInterface;

class DeleteTaskHandler implements HandlerInterface
{
    /** @var TaskRepositoryInterface  */
    private $taskRepository;

    /**
     * DeleteTaskHandler constructor.
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param DeleteTaskCommand $command
     * @throws \Exception
     */
    public function handle(CommandInterface $command): void
    {
        $this->taskRepository->delete($command->id());
    }
}
