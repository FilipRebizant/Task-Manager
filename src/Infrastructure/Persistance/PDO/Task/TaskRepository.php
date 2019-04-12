<?php

namespace App\Infrastructure\Persistance\PDO\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use App\Domain\Task\ValueObject\Status;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use Ramsey\Uuid\Uuid;

class TaskRepository implements TaskRepositoryInterface
{
    /** @var PDOConnector */
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
    public function create(Task $task): void
    {
        if ($task->getAssignedUser()) {
            $userId = $task->getAssignedUser()->getId();
        }

//
//        Ramsey\Uuid\Uuid::setFactory($factory);
//        $uuidString1 = Ramsey\Uuid\Uuid::uuid4()->toString();
//        $uuidString2 = Ramsey\Uuid\Uuid::uuid4()->toString();
//
//        print "Generated uuids: {$uuidString1} and {$uuidString2}" . PHP_EOL;



        $test = $task->getId();
        var_dump($test->getBytes());
        var_dump($test->getBytes());
        var_dump(($test->toString()));

        $data = [
            "id" => $test,
            "title" => $task->getTitle(),
            "status" => $task->getStatus(),
            "priority" => (int)$task->getPriority(),
            "description" => $task->getDescription(),
            "created_at" => $task->getCreatedAt()->format('Y-m-d H:i:s'),
            "user_id" => null,
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `tasks` (`id`, `title`, `status`, `user_id`,`priority`, `description`, `created_at`) VALUES(:id, :title, :status, :user_id, :priority, :description, :created_at)";
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
    public function delete(int $taskId): void
    {
        $this->pdo->beginTransaction();
        $sql = "DELETE FROM `tasks` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $taskId]);
        $this->pdo->commit();
    }

    /**
     * @param int $taskId
     * @param int $userId
     */
    public function assignUserToTask(int $taskId, int $userId): void
    {
        $sql = "UPDATE tasks
                SET user_id = :user_id
                WHERE id = :task_id
        ";
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'task_id' => $taskId,
            'user_id' => $userId,
        ]);
        $this->pdo->commit();
    }

    /**
     * @param int $taskId
     * @param Status $status
     */
    public function changeStatus(int $taskId, Status $status): void
    {
        $sql = "UPDATE tasks
                SET status = :status
                WHERE id = :id
        ";

        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'status' => $status,
            'id' => $taskId,
        ]);
    }
}
