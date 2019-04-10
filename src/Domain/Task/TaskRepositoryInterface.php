<?php

namespace App\Domain\Task;

Interface TaskRepositoryInterface
{
    /**
     * @param Task $task
     */
    public function create(Task $task): void;

    /**
     * @param int $taskId
     */
    public function delete(int $taskId): void;

    /**
     * @param int $taskId
     * @param int $userId
     */
    public function assignUserToTask(int $taskId, int $userId): void;
}
