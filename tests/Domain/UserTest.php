<?php

namespace App\Tests\Domain;

use App\Domain\Task;
use App\Domain\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCanAssignTask()
    {
        $user = new User();
        $task = new Task();

        $user->assignTask($task);
        $assignedTask = end($user->getAssignedTasks());

        $this->assertEquals($task, $assignedTask);
    }

    public function testUserCanGetAssignedTasks()
    {
        $user = new User();
        $task = new Task();
        $secondTask = new Task();

        $task->setDescription('task1');
        $secondTask->setDescription('task2');

        $user->assignTask($task);
        $user->assignTask($secondTask);

        $expectedCount = 2;
        $actualCount = count($user->getAssignedTasks());

        $this->assertEquals($expectedCount, $actualCount);
    }

    public function testUserCanUnassignTask()
    {
        $user = new User();
        $task = new Task();
        $secondTask = new Task();

        $task->setDescription('task1');
        $secondTask->setDescription('task2');

        $user->assignTask($task);
        $user->assignTask($secondTask);

        $user->unassignTask($secondTask);

        $actualCount = end($user->getAssignedTasks());

        $this->assertEquals($task, $actualCount);
    }

    public function testUserCanNotRemoveUnassignedTasks()
    {
        $user = new User();
        $task = new Task();
        $secondTask = new Task();
        $thirdTask = new Task;

        $task->setDescription('task1');
        $secondTask->setDescription('task2');
        $thirdTask->setDescription('unassignedTask');

        $user->assignTask($task);
        $user->assignTask($secondTask);

        $user->unassignTask($thirdTask);

        $expectedCount = 2;
        $actualCount = count($user->getAssignedTasks());

        $this->assertEquals($expectedCount, $actualCount);
    }
}
