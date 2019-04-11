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
     * @param int $taskId
     * @param int $userId
     */
    public function assignUserToTask(int $taskId, int $userId): void;

    /**
     * @param int $taskId
     * @param Status $status
     */
    public function changeStatus(int $taskId, Status $status): void;
}
