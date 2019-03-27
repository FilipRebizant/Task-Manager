<?php

namespace App\Tests\Domain;

use App\Domain\Task;
use App\Domain\User;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testAssignTaskIsToDo()
    {
        $task = new Task();

        $task->setToDo();
        $status = $task->getStatus();
        $expectedStatus = 1;

        $this->assertEquals($expectedStatus, $status);
    }

    public function testAssignTaskIsPending()
    {
        $task = new Task();

        $task->setPending();
        $status = $task->getStatus();
        $expectedStatus = 2;

        $this->assertEquals($expectedStatus, $status);
    }

    public function testAssignTaskIsDone()
    {
        $task = new Task();

        $task->setDone();
        $status = $task->getStatus();
        $expectedStatus = 3;
        
        $this->assertEquals($expectedStatus, $status);
    }

    public function testTaskCanGetAssignedUser()
    {
        $task = new Task();
        $user = new User();

        $user->assignTask($task);
        $assignedUser = $task->getAssignedUser();

        $this->assertEquals($user, $assignedUser);
    }

    public function testTaskCanAssignUser()
    {
        $user = new User();
        $task = new Task();

        $user->setUserName('username');
        $task->assignUser($user);
        $username = $task->getAssignedUser()->getUserName();
        $expectedUserName = 'username';

        $this->assertEquals($expectedUserName, $username);
    }

    public function testTaskCanUnassignUser()
    {
        $user = new User();
        $task = new Task();

        $user->assignTask($task);
        $task->unassignUser($user);
        $assignedUser = $task->getAssignedUser();

        $this->assertEquals(null, $assignedUser);
    }

    public function testTaskWillNotUnassignWrongUser()
    {
        $user = new User();
        $wrongUser = new User();
        $task = new Task();

        $user->setUserName('username');
        $wrongUser->setUserName('wrongUsername');

        $user->assignTask($task);
        $task->unassignUser($wrongUser);
        $assignedUser = $task->getAssignedUser();

        $this->assertEquals($user, $assignedUser);
    }

    public function testTaskWillNotBeReassigned()
    {
        $user = new User();
        $wrongUser = new User();
        $task = new Task();

        $user->setUserName('user');
        $wrongUser->setUserName('wrongUser');

        $task->assignUser($user);
        $task->assignUser($wrongUser);

        $assignedUser = $task->getAssignedUser();

        $this->assertEquals($user, $assignedUser);
    }
}
