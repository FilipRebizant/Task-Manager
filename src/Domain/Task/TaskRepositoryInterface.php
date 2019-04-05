<?php

namespace App\Domain\Task;

Interface TaskRepositoryInterface
{
    /**
     * @param Task $task
     */
    public function create();

    /**
     * @param Task $task
     */
    public function remove(Task $task);
}
