<?php

namespace App\Domain\Task;

use App\Domain\Task\ValueObject\Status;

Interface TaskRepositoryInterface
{
    /**
     * @param Task $task
     */
    public function create(Task $task): void;

    /**
     * @param string $taskId
     */
    public function delete(string $taskId): void;

    /**
     * @param string $taskId
     * @param string $userId
     */
    public function assignUserToTask(string $taskId, string $userId): void;

    /**
     * @param string $taskId
     * @param Status $status
     */
    public function changeStatus(string $taskId, Status $status): void;
}
