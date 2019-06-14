<?php

namespace App\Tests\Unit\Domain\Task;

use App\Domain\Task\Exception\InvalidStatusOrderException;
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
            new Title("Title of the task"),
            new Status("Todo"),
            $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock(),
            new Priority(1),
            new Description("Description")
        );
        $this->userMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
    }

    public function testAssignedTaskIsToDo()
    {
        $expectedStatus = "Todo";
        $status = $this->task->getStatus();

        $this->assertEquals($expectedStatus, $status);
    }

    public function testAssignedTaskIsPending()
    {
        $this->task->changeStatus(new Status('Pending'));

        $expectedStatus = "Pending";
        $status = $this->task->getStatus();

        $this->assertEquals($expectedStatus, $status);
    }

    public function testAssignedTaskIsDone()
    {
        $expectedStatus = "Done";

        $this->task->changeStatus(new Status("Pending"));
        $this->task->changeStatus(new Status("Done"));
        $status = $this->task->getStatus();

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
        $user = $this->task->getAssignedUser();

        $this->task->assignUser($this->userMock);

        $this->assertEquals($this->userMock, $user);
    }

    public function testTaskCanUnassignUser()
    {
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

    public function testCanChangeStatusFromDoneToTodo()
    {
        $toDoStatus = new Status("Todo");
        $pendingStatus = new Status("Pending");
        $doneStatus = new Status("Done");

        $this->task->changeStatus($pendingStatus);
        $this->task->changeStatus($doneStatus);
        $this->task->changeStatus($toDoStatus);
        $actualStatus = $this->task->getStatus();

        $this->assertEquals("Todo", $actualStatus);
    }

    public function testExpectsInvalidOrderExceptionWhenChangingFromToDoToDone()
    {
        $doneStatus = new Status("Done");

        $this->expectException(InvalidStatusOrderException::class);

        $this->task->changeStatus($doneStatus);
    }

    public function testExpectsInvalidOrderExceptionWhenChangingFromPendingToToDo()
    {
        $toDoStatus = new Status("Todo");

        $this->expectException(InvalidStatusOrderException::class);

        $this->task->changeStatus($toDoStatus);
    }
}
