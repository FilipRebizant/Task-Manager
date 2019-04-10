<?php

namespace App\Application\Query\Task;

interface TaskQueryInterface
{
    /**
     * @param string $userId
     * @return TaskView
     */
    public function getById(string $userId): TaskView;

    /**
     * @return array
     */
    public function getAll(): array;
}
