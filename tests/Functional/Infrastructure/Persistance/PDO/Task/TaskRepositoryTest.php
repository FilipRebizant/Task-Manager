<?php

namespace App\Tests\Functional\Infrastructure\Persistance\PDO\Task;

use App\Application\Query\Task\TaskQueryInterface;
use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\ValueObject\Title;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Zalas\Injector\PHPUnit\Symfony\TestCase\SymfonyTestContainer;
use Zalas\Injector\PHPUnit\TestCase\ServiceContainerTestCase;

class TaskRepositoryTest extends TestCase implements ServiceContainerTestCase
{
    use SymfonyTestContainer;

    /**
     * @var TaskRepositoryInterface
     * @inject
     */
    private $taskRepository;

    /**
     * @var UserRepositoryInterface
     * @inject
     */
    private $userRepository;

    /**
     * @var TaskQueryInterface
     * @inject
     */
    private $taskQuery;

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

        $this->taskRepository->create($task);
        $this->userRepository->create($user, null);
        $taskId = $task->getId()->toString();
        $this->taskRepository->assignTaskToUser($taskId, $user->getUserName());
        $actuallyAssignedUser = $this->taskQuery->getById($taskId)->user();

        $this->assertEquals($user->getUserName(), $actuallyAssignedUser);

        $this->taskRepository->delete($task->getId());
        $this->userRepository->delete($user->getId());
    }
}
