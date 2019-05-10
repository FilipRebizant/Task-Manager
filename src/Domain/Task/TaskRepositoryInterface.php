<?php

namespace App\Domain\Task;

use App\Domain\Task\ValueObject\Status;
use App\Infrastructure\Exception\NotFoundException;

interface TaskRepositoryInterface
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
     * @throws NotFoundException
     */
    public function assignTaskToUser(string $taskId, string $userId): void;

    /**
     * @param string $taskId
     * @param Status $status
     * @throws NotFoundException
     */
    public function changeStatus(string $taskId, Status $status): void;

    /**
     * @param string $taskId
     * @return Task
     * @throws NotFoundException
     */
    public function getTaskById(string $taskId): Task;

    /**
     * @param string $taskId
     * @param string $userId
     * @return bool
     * @throws NotFoundException
     */
    public function taskAlreadyAssignedToUser(string $taskId, string $userId): bool;
}
