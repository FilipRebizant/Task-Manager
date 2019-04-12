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
     * @param int $taskId
     */
    public function delete(int $taskId): void;

    /**
     * @param string $taskId
     * @param string $userId
     */
    public function assignUserToTask(string $taskId, string $userId): void;

    /**
     * @param int $taskId
     * @param Status $status
     */
    public function changeStatus(int $taskId, Status $status): void;
}
