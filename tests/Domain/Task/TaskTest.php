<?php

namespace App\Tests\Domain\Task;

use App\Domain\Task\Task;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\ValueObject\Title;
use App\Domain\User\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

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
        $this->task = new Task(
            $this->getMockBuilder(Uuid::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(Title::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(Status::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(Priority::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(Description::class)->disableOriginalConstructor()->getMock()
        );
        $this->userMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
    }

    public function testAssignTaskIsToDo()
    {
        $this->task->updateStatus(new Status("Todo"));
        $status = $this->task->getStatus();
        $expectedStatus = "Todo";

        $this->assertEquals($expectedStatus, $status);
    }

    public function testAssignTaskIsPending()
    {
        $this->task->updateStatus(new Status('Pending'));
        $status = $this->task->getStatus();
        $expectedStatus = "Pending";

        $this->assertEquals($expectedStatus, $status);
    }

    public function testAssignTaskIsDone()
    {
        $this->task->updateStatus(new Status('Done'));
        $status = $this->task->getStatus();
        $expectedStatus = "Done";

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
//        $this->task->assignUser($this->userMock);

        $this->task->unassignUser($this->task->getAssignedUser());
        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals(null, $assignedUser);
    }

    public function testTaskWillNotUnassignWrongUser()
    {
        $wrongUserMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();

        $this->task->assignUser($this->userMock);
        $this->task->unassignUser($wrongUserMock);
        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals($this->userMock, $assignedUser);
    }

    public function testTaskWillNotBeReassigned()
    {
        $wrongUserMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();

        $this->task->assignUser($this->userMock);

        $this->task->assignUser($wrongUserMock);

        $assignedUser = $this->task->getAssignedUser();

        $this->assertEquals($this->userMock, $assignedUser);
    }
}
