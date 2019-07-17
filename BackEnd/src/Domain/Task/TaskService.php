<?php

namespace App\Domain\Task;

use App\Application\Command\AssignTaskToUserCommand;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Exception\NotFoundException;

class TaskService
{
    /** @var TaskRepositoryInterface */
    private $taskRepository;

    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepositoryInterface $taskRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository, UserRepositoryInterface $userRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param AssignTaskToUserCommand $command
     * @throws NotFoundException
     * @throws UserAlreadyExistsException
     */
    public function assignUserToTask(AssignTaskToUserCommand $command): void
    {
        if (!$this->userExists($command->user())) {
            throw new NotFoundException("User was not found");
        }

        if (!$this->userAlreadyAssigned($command->task(), $command->user())) {
            $this->taskRepository->assignTaskToUser(
                $command->task(),
                $command->user()
            );
        }
    }

    /**
     * @param string $taskId
     * @param string $userId
     * @throws UserAlreadyExistsException
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    private function userAlreadyAssigned(string $taskId, string $userId): bool
    {
        if ($this->taskRepository->taskAlreadyAssignedToUser($taskId, $userId)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $username
     * @return bool
     * @throws NotFoundException
     */
    private function userExists(string $username): bool
    {
        if (!$this->userRepository->checkIfUsernameExists($username)) {
            return false;
        }

        return true;
    }
}
