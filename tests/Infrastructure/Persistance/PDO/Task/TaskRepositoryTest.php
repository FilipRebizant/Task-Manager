<?php

namespace App\Tests\Infrastructure\Persistance\PDO\Task;

use App\Domain\Task\Task;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\ValueObject\Title;
use App\Domain\User\User;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\Task\TaskRepository;
use App\Infrastructure\Persistance\PDO\Task\TaskQuery;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class TaskRepositoryTest extends TestCase
{
    /** @var TaskRepository */
    private $taskRepository;

    /** @var TaskQuery */
    private $taskQuery;

    /** @var PDOConnector */
    private $pdo;

    /** @var Uuid */
    private $uuid;

    protected function setUp(): void
    {
        $this->pdo = new PDOConnector();
        $this->taskRepository = new TaskRepository($this->pdo);
        $this->taskQuery = new TaskQuery($this->pdo);
        $this->uuid = Uuid::uuid4();
    }

    /**
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function testCanCreateNewTaskWithoutUser()
    {
        $task = new Task(
            $this->uuid,
            new Title("Title of the task"),
            new Status("Todo"),
            null,
            new Priority(1),
            new Description("Short description")
        );

        $this->taskRepository->create($task);
        $taskView = $this->taskQuery->getById($this->uuid->toString());

        $this->assertEquals($taskView->id(), $task->getId()->toString());
    }

    /**
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Infrastructure\Exception\NotFoundException
     * @throws \ReflectionException
     */
    public function testCanCreateNewTaskWithUser()
    {
        $userMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $task = new Task(
            $this->uuid,
            new Title("Task with user assigned"),
            new Status("Todo"),
            $userMock,
            new Priority(1),
            new Description("Task with user assigned")
        );

        $this->taskRepository->create($task);
        $taskView = $this->taskQuery->getById($this->uuid->toString());

        $this->assertEquals($taskView->id(), $task->getId()->toString());
    }
}
