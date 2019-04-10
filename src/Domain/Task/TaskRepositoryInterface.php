<?php

namespace App\Domain\Task;

Interface TaskRepositoryInterface
{
    /**
     * @param Task $task
     */
    public function create(Task $task);

    /**
     * @param int $taskId
     */
    public function delete(int $taskId);
}
