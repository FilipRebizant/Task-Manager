<?php

namespace App\Domain\Task;


use App\Domain\Task\Task;

Interface TaskRepository
{
    /**
     * @param Task $task
     */
    public function create(Task $task);

    /**
     * @param Task $task
     */
    public function remove(Task $task);
}
