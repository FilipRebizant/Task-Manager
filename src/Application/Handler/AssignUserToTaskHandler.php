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
     * CreateNewTaskHandler constructor.
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
//        try {
//            $this->taskRepository->getById( '6ab11e5d-b98e-40a0-ac9b-ed2bc9c20d51');
//
//        } catch (\Exception $e) {
//            echo $e->getMessage();
//        }
//        var_dump($command);
        $this->taskRepository->assignUserToTask(
            $command->task(),
            $command->user(),
        );
//        $this->taskRepository->assignUserToTask(
//            $command->task(),
//            $command->user(),
//        );
    }
}
