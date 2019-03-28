<?php

namespace App\Tests\Domain;

use App\Domain\Task;
use App\Domain\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{

    /** @var User */
    protected $user;

    /** @var Task */
    protected $task;

    /** @var MockObject */
    protected $userMock;

    public function setUp(): void
    {
        $this->task = new Task();
        $this->userMock = $this->getMockBuilder(User::class)->getMock();
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
        $this->task->assignUser($this->userMock);

        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals($this->userMock, $assignedUser);
    }

    public function testTaskCanAssignUser()
    {
        $this->task->assignUser($this->userMock);
        $user = $this->task->getAssignedUser();

        $this->assertEquals($this->userMock, $user);
    }

    public function testTaskCanUnassignUser()
    {
        $this->task->assignUser($this->userMock);

        $this->task->unassignUser($this->userMock);
        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals(null, $assignedUser);
    }

    public function testTaskWillNotUnassignWrongUser()
    {
        $wrongUserMock = $this->getMockBuilder(User::class)->getMock();

        $this->task->assignUser($this->userMock);
        $this->task->unassignUser($wrongUserMock);
        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals($this->userMock, $assignedUser);
    }

    public function testTaskWillNotBeReassigned()
    {
        $wrongUserMock = $this->getMockBuilder(User::class)->getMock();

        $this->task->assignUser($this->userMock);

        $this->task->assignUser($wrongUserMock);

        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals($this->userMock, $assignedUser);
    }
}
