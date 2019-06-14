<?php

namespace App\Tests\Infrastructure\Persistance\PDO\Task;

use App\Domain\Task\Task;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\ValueObject\Title;
use App\Domain\User\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
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
            new Title("Task without user"),
            new Status("Todo"),
            null,
            new Priority(1),
            new Description("Task without user")
        );

        $this->taskRepository->create($task);
        $taskView = $this->taskQuery->getById($uuid->toString());

        $this->assertEquals($taskView->id(), $task->getId()->toString());

        $this->taskRepository->delete($task->getId());
    }

    /**
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Infrastructure\Exception\NotFoundException
     * @throws \ReflectionException
     */
    public function testCanCreateNewTaskWithUser()
    {
        $uuid = Uuid::uuid4();
        $userMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
        $task = new Task(
            $uuid,
            new Title("Task with user "),
            new Status("Done"),
            $userMock,
            new Priority(1),
            new Description("Task with user")
        );

        $this->taskRepository->create($task);
        $taskView = $this->taskQuery->getById($uuid->toString());

        $this->assertEquals($taskView->id(), $task->getId()->toString());

        $this->taskRepository->delete($task->getId());
    }

    /**
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function testCanAssignUserToTask()
    {
        $uuid = Uuid::uuid4();

        $task = new Task(
            $uuid,
            new Title("Task to assign user"),
            new Status("Todo"),
            null,
            new Priority(1),
            new Description("Task to assign user")
        );
        $user = new User(
            Uuid::uuid4(),
            new Username('username'),
            new Email('username@gmail.com'),
            new Role('ADMIN'),
            array()
        );
        $userRepository = new UserRepository($this->pdo);

        $this->taskRepository->create($task);
        $userRepository->create($user, null);
        $taskId = $task->getId()->toString();
        $this->taskRepository->assignTaskToUser($taskId, $user->getUserName());
        $actuallyAssignedUser = $this->taskQuery->getById($taskId)->user();

        $this->assertEquals($user->getUserName(), $actuallyAssignedUser);

        $this->taskRepository->delete($task->getId());
        $userRepository->delete($user->getId());
    }
}
