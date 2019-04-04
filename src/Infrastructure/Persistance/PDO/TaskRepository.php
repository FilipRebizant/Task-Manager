<?php

namespace App\Infrastructure\Persistance\PDO;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @param Task $task
     */
    public function create(Task $task)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param Task $task
     */
    public function remove(Task $task)
    {
        // TODO: Implement remove() method.
    }
}
