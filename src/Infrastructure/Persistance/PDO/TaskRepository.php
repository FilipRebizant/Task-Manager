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
            "description" => $task->getDescription(),
            "status" => $task->getStatus(),
            "priority" => $task->getPriority()
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `tasks` (`description`, `status`, `priority`) VALUES(:description, :status, :priority)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $this->pdo->commit();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param int $taskId
     */
    public function delete(int $taskId)
    {
        $this->pdo->beginTransaction();
        $sql = "DELETE FROM `tasks` WHERE `tasks.id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $taskId]);
        $this->pdo->commit();
    }
}
