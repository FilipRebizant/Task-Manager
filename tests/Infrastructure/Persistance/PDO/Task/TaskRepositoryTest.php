<?php

namespace App\Tests\Infrastructure\Persistance\PDO\Task;

use App\Domain\Task\Task;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\ValueObject\Title;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\Task\TaskRepository;
use App\Infrastructure\Persistance\PDO\Task\TaskQuery;
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

    protected function setUp(): void
    {
        $this->pdo = new PDOConnector();
        $this->taskRepository = new TaskRepository($this->pdo);
        $this->taskQuery = new TaskQuery($this->pdo);
    }

    /**
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function testCanCreateNewTaskWithoutUser()
    {
        $uuid = Uuid::uuid4();
        $task = new Task(
            $uuid,
            new Title("Title of the task"),
            new Status('Todo'),
            null,
            new Priority(1),
            new Description("Short description")
        );

        $this->taskRepository->create($task);
        $taskView = $this->taskQuery->getById($uuid->toString());

        $this->assertEquals($taskView->id(), $task->getId()->toString());
    }
}
