<?php

namespace App\Tests\Domain;

use App\Domain\Task;

use App\Domain\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /** @var User */
    protected $user;

    /** @var Task */
    protected $task;

    public function setUp(): void
    {
        $this->user = new User();
        $this->task = new Task();
    }

    public function testUserCanAssignTask()
    {
        $this->user->assignTask($this->task);
        $assignedTask = end($this->user->getAssignedTasks());

        $this->assertEquals($this->task, $assignedTask);
    }

    public function testUserCanGetAssignedTasks()
    {
        $secondTask = new Task();

        $this->task->setDescription('task1');
        $secondTask->setDescription('task2');

        $this->user->assignTask($this->task);
        $this->user->assignTask($secondTask);

        $expectedCount = 2;
        $actualCount = count($this->user->getAssignedTasks());

        $this->assertEquals($expectedCount, $actualCount);
    }

    public function testUserCanUnassignTask()
    {
        $secondTask = new Task();

        $this->task->setDescription('task1');
        $secondTask->setDescription('task2');

        $this->user->assignTask($this->task);
        $this->user->assignTask($secondTask);

        $this->user->unassignTask($secondTask);

        $actualCount = end($this->user->getAssignedTasks());

        $this->assertEquals($this->task, $actualCount);
    }

    public function testUserCanNotRemoveUnassignedTasks()
    {
        $secondTask = new Task();
        $thirdTask = new Task;

        $this->task->setDescription('task1');
        $secondTask->setDescription('task2');
        $thirdTask->setDescription('unassignedTask');

        $this->user->assignTask($this->task);
        $this->user->assignTask($secondTask);

        $this->user->unassignTask($thirdTask);

        $expectedCount = 2;
        $actualCount = count($this->user->getAssignedTasks());

        $this->assertEquals($expectedCount, $actualCount);
    }
}
