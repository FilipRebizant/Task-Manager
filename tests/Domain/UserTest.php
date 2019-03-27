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

        $assignedTask = $user->assignTask($task);
        $obj = $this->getMockBuilder(Task::class)
            ->setMethods(array('getStatus'))
            ->getMock();

        $this->assertEquals($obj, $assignedTask);
    }
}
