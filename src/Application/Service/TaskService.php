<?php

namespace App\Service;


use App\Domain\Repository\TaskRepository;
use App\Domain\Task;
use App\Domain\User;

class TaskService
{
    /** @var TaskRepository */
    private $taskRepository;

    /**
     * TaskService constructor.
     * @param User $user
     * @param Task $task
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param User $user
     * @param string $description
     * @param int $priority
     * @return bool
     * @throws \Exception
     */
    public function createTask(User $user, string $description, int $priority): bool
    {
        try {
            $task = new Task();
            $task->setDescription($description);
            $task->setPriority($priority);
            $task->assignUser($user);
            $task->setToDo();
            $task->setCreatedAt(new \DateTimeImmutable('now'));

            $this->taskRepository->create($task);

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }
}
