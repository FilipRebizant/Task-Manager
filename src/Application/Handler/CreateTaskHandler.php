<?php

namespace App\Application\Handler;

use App\Application\Command\CreateTaskCommand;
use App\Application\CommandInterface;
use App\Application\HandlerInterface;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use App\Domain\Task\ValueObject\Title;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Persistance\PDO\Task\TaskRepository;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use Ramsey\Uuid\Uuid;

class CreateTaskHandler implements HandlerInterface
{
    /** @var TaskRepositoryInterface */
    private $taskRepository;

    /** @var UserRepository */
    private $userRepository;

    /**
     * CreateTaskHandler constructor.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository, UserRepository $userRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param CommandInterface|CreateTaskCommand $command
     * @throws \App\Domain\Exception\InvalidArgumentException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        if (!empty($command->user())) {
            $user = $this->userRepository->getByUsername(new Username($command->user()));
        } else {
            $user = null;
        }

        $task = new Task(
            Uuid::uuid4(),
            new Title($command->title()),
            new Status("Todo"),
            $user,
            new Priority($command->priority()),
            new Description($command->description())
        );

        $this->taskRepository->create($task);
    }
}
