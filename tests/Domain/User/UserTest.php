<?php

namespace App\Tests\Domain\User;

use App\Domain\Task\Task;

use App\Domain\User\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /** @var User */
    protected $user;

    /** @var Task */
    protected $task;

    /** @var MockObject */
    protected $taskMock;

    public function setUp(): void
    {
        $this->user = new User();
        $this->taskMock = $this->getMockBuilder(Task::class)->disableOriginalConstructor()->getMock();
    }

    public function testUserCanAssignTask()
    {
        $this->user->assignTask($this->taskMock);
        $assignedTask = end($this->user->getAssignedTasks());

        $this->assertEquals($this->taskMock, $assignedTask);
    }

    public function testUserCanGetAssignedTasks()
    {
        $secondTaskMock = $this->getMockBuilder(Task::class)->disableOriginalConstructor()->getMock();

        $this->user->assignTask($this->taskMock);
        $this->user->assignTask($secondTaskMock);

        $expectedCount = 2;
        $actualCount = count($this->user->getAssignedTasks());

        $this->assertEquals($expectedCount, $actualCount);
    }

    public function testUserCanUnassignTask()
    {
        $secondTaskMock = $this->getMockBuilder(Task::class)->disableOriginalConstructor()->getMock();

        $this->user->assignTask($this->taskMock);
        $this->user->assignTask($secondTaskMock);

        $this->user->unassignTask($secondTaskMock);

        $actualCount = end($this->user->getAssignedTasks());

        $this->assertEquals($this->taskMock, $actualCount);
    }

    public function testUserCanNotRemoveUnassignedTasks()
    {
        $secondTaskMock = $this->getMockBuilder(Task::class)->disableOriginalConstructor()->getMock();
        $thirdTaskMock = $this->getMockBuilder(Task::class)->disableOriginalConstructor()->getMock();

        $this->user->assignTask($this->taskMock);
        $this->user->assignTask($secondTaskMock);

        $this->user->unassignTask($thirdTaskMock);

        $expectedCount = 2;
        $actualCount = count($this->user->getAssignedTasks());

        $this->assertEquals($expectedCount, $actualCount);
    }
}
