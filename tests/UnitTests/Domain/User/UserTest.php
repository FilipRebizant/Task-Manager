<?php

namespace App\Tests\Domain\User;

use App\Domain\Task\Task;
use App\Domain\User\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

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
        $this->user = new User(
            Uuid::uuid4(),
            new Username('username'),
            new Email('email@gmail.com'),
            new Role('ADMIN'),
            array()
        );
        $this->taskMock = $this->getMockBuilder(Task::class)->disableOriginalConstructor()->getMock();
    }

    public function testUserCanAssignTask()
    {
        $this->user->assignTask($this->taskMock);
        $tasks = $this->user->getAssignedTasks();
        $assignedTask = end($tasks);

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
        $tasks = $this->user->getAssignedTasks();
        $actualCount = end($tasks);

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

    public function testSetters()
    {
        $date = new \DateTimeImmutable();
        $date->setDate(2000,1,1);

        $this->user->setPassword(new Password('NewPassword'));
        $this->user->setRole(new Role('USER'));
        $this->user->setCreatedAt($date);
        $this->user->setUserName(new Username('newUsername'));
        $this->user->setEmail(new Email('newEmail@email.com'));

        $this->assertEquals('USER', $this->user->getRole());
        $this->assertEquals('NewPassword', $this->user->getPassword());
        $this->assertEquals($date, $this->user->getCreatedAt());
    }
}
