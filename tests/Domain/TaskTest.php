<?php

namespace App\Tests\Domain;

use App\Domain\Task;
use App\Domain\User;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{

    /** @var User */
    protected $user;

    /** @var Task */
    protected $task;

    public function setUp(): void
    {
        $this->task = new Task();
        $this->user = new User();
    }

    public function testAssignTaskIsToDo()
    {
        $this->task->setToDo();
        $status = $this->task->getStatus();
        $expectedStatus = 1;

        $this->assertEquals($expectedStatus, $status);
    }

    public function testAssignTaskIsPending()
    {
        $this->task->setPending();
        $status = $this->task->getStatus();
        $expectedStatus = 2;

        $this->assertEquals($expectedStatus, $status);
    }

    public function testAssignTaskIsDone()
    {
        $this->task->setDone();
        $status = $this->task->getStatus();
        $expectedStatus = 3;
        
        $this->assertEquals($expectedStatus, $status);
    }

    public function testTaskCanGetAssignedUser()
    {
        $this->user->assignTask($this->task);
        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals($this->user, $assignedUser);
    }

    public function testTaskCanAssignUser()
    {
        $this->user->setUserName('username');
        $this->task->assignUser($this->user);
        $username = $this->task->getAssignedUser()->getUserName();
        $expectedUserName = 'username';

        $this->assertEquals($expectedUserName, $username);
    }

    public function testTaskCanUnassignUser()
    {
        $this->user->assignTask($this->task);
        $this->task->unassignUser($this->user);
        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals(null, $assignedUser);
    }

    public function testTaskWillNotUnassignWrongUser()
    {
        $wrongUser = new User();

        $this->user->setUserName('username');
        $wrongUser->setUserName('wrongUsername');

        $this->user->assignTask($this->task);
        $this->task->unassignUser($wrongUser);
        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals($this->user, $assignedUser);
    }

    public function testTaskWillNotBeReassigned()
    {
        $wrongUser = new User();

        $this->user->setUserName('user');
        $wrongUser->setUserName('wrongUser');

        $this->task->assignUser($this->user);
        $this->task->assignUser($wrongUser);

        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals($this->user, $assignedUser);
    }
}
