<?php

namespace App\Domain\Task;

use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\ValueObject\Title;
use App\Domain\User\UserFactory;
use Ramsey\Uuid\Uuid;

class TaskFactory
{
    /**
     * @param array $data
     * [
     *      'id' => string
     *      'title' => string
     *      'status' => string
     *      'user' => array [
     *              'id' => string
     *              'username' => string
     *              'email' => string
     *              'role' => string
     *              'tasks' => Task|null
     *      ]
     *      'priority' => int
     *      'description' => string
     * ]
     * @return Task
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function create(array $data): Task
    {
        $user = null;

        if (array_key_exists('id', $data['user'])) {
            $userFactory = new UserFactory();
            $userDataArray = $data['user'];
            $user = $userFactory->create($userDataArray);
        }

        $task = new Task(
            Uuid::fromString($data['id']),
            new Title($data['title']),
            new Status($data['status']),
            $user,
            new Priority($data['priority']),
            new Description($data['description'])
        );
        return $task;
    }
}
