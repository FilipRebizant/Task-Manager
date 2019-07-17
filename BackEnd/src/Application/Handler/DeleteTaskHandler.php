<?php

namespace App\Application\Handler;

use App\Application\Command\DeleteTaskCommand;
use App\Domain\Task\TaskRepositoryInterface;

class DeleteTaskHandler
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
    public function handle(DeleteTaskCommand $command): void
    {
        $this->taskRepository->delete($command->id());
    }
}
