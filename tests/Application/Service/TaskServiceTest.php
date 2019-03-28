<?php

namespace App\Tests\Service;


use App\Domain\Task;
use App\Domain\User;
use App\Service\TaskService;

class TaskServiceTest
{
    /** @var User */
    private $user;

    /** @var Task */
    private $task;

    /** @var TaskService */
    private $taskService;

    public function setUp()
    {

    }

    /**
     * @test
     */
    public function can_create_task()
    {
        $this->taskService->createTask();
    }
}
