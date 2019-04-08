<?php

namespace App\Infrastructure\Persistance\PDO;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /** @var PDOConnector  */
    private $pdo;

    /**
     * TaskRepository constructor.
     * @param PDOConnector $pdo
     */
    public function __construct(PDOConnector $pdo)
    {
        $this->pdo = $pdo->getConnection();
    }

    /**
     * @param Task $task
     */
    public function create(Task $task)
    {
        $data = [
            "description" => $task->getDescription()
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `tasks` (`desc`) VALUES(:description)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $this->pdo->commit();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param Task $task
     */
    public function remove(Task $task)
    {
        // TODO: Implement remove() method.
    }
}
