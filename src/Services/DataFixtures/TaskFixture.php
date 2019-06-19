<?php

namespace App\Services\DataFixtures;

use App\Domain\Task\Task;
use App\Domain\Task\TaskFactory;
use App\Domain\Task\TaskRepositoryInterface;
use Ramsey\Uuid\Uuid;

class TaskFixture extends BaseFixture
{
    /** @var TaskFactory  */
    private $taskFactory;

    /** @var TaskRepositoryInterface  */
    private $taskRepository;

    private $statuses = [
        'Todo',
        'Pending',
        'Done'
    ];

    /**
     * TaskFixture constructor.
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        parent::__construct();

        $this->taskRepository = $taskRepository;
        $this->taskFactory = new TaskFactory();
    }

    /**
     * @param array $objects
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function loadTask(array $objects = []): Task
    {
        $data = [
            'id' => Uuid::uuid4()->toString(),
            'title' => $this->faker->words(3, true),
            'status' => $this->statuses[$this->faker->numberBetween(0, 2)],
            'user' => $objects['user'],
            'priority' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->words(10, true),
        ];
        $task = $this->taskFactory->create($data);
        $this->taskRepository->create($task);

        return $task;
    }

    /**
     * @return Task
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function loadTaskWithoutUser(): Task
    {
        $data = [
            'id' => Uuid::uuid4()->toString(),
            'title' => $this->faker->words(3, true),
            'status' => 'Todo',
            'user' => null,
            'priority' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->words(10, true),
        ];
        $task = $this->taskFactory->create($data);
        $this->taskRepository->create($task);

        return $task;
    }
}
