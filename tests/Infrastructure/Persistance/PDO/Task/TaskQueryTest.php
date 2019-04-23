<?php

namespace App\Tests\Infrastructure\Persistance\PDO\Task;

use App\Application\Query\Task\TaskView;
use App\Domain\Task\Task;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\ValueObject\Title;
use App\Domain\User\User;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\Task\TaskQuery;
use App\Infrastructure\Persistance\PDO\Task\TaskRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class TaskQueryTest extends TestCase
{
    /** @var TaskQuery */
    private $taskQuery;

    /** @var TaskRepository */
    private $taskRepository;

    /** @var PDOConnector */
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDOConnector();
        $this->taskQuery = new TaskQuery($this->pdo);
        $this->taskRepository = new TaskRepository($this->pdo);
    }

    public function testCanRetrieveTasks()
    {
        $uuid = Uuid::uuid4();
        $task = new Task(
            $uuid,
            new Title('Title to test UserQuery without user'),
            new Status('Todo'),
            null,
            new Priority(1),
            new Description("Description")
        );

        $this->taskRepository->create($task);

        $tasks = $this->taskQuery->getAll();

        foreach ($tasks as $task) {
            $this->assertInstanceOf(TaskView::class, $task);
        }
    }

    public function testCanRetrieveTaskWithoutUser()
    {
        $uuid = Uuid::uuid4();
        $task = new Task(
            $uuid,
            new Title('Title to test UserQuery without user'),
            new Status('Todo'),
            null,
            new Priority(1),
            new Description("Description")
        );

        $this->taskRepository->create($task);
        $retrievedTask = $this->taskQuery->getById($uuid->toString())->id();

        $this->assertEquals($uuid->toString(), $retrievedTask);
    }
}
