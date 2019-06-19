<?php

namespace App\Services\DataFixtures;

use App\Domain\Task\TaskFactory;
use App\Domain\Task\TaskRepositoryInterface;
use Ramsey\Uuid\Uuid;

class TaskFixture extends BaseFixture
{
    /** @var TaskFactory  */
    private $taskFactory;

    /** @var TaskRepositoryInterface  */
    private $taskRepository;

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

    public function loadTasks(array $objects = [])
    {
        for ($i = 0; $i <= self::NUMBER_OF_OBJECTS; $i++) {
            $data = [
                'id' => Uuid::uuid4()->toString(),
                'title' => $this->faker->words(3, true),
                'status' => 'Todo',
                'user' => $objects['user'],
                'priority' => $this->faker->numberBetween(1, 10),
                'description' => $this->faker->words(10, true),
            ];
            $task = $this->taskFactory->create($data);
            $this->taskRepository->create($task);
        }
    }
}
