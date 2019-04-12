<?php

namespace App\Infrastructure\Persistance\PDO\Task;

use App\Application\Query\Task\TaskView;
use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use App\Domain\Task\ValueObject\Status;
use App\Domain\User\User;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use PDO;
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
     * @param string $taskId
     * @param string $userId
     */
    public function assignUserToTask(string $taskId, string $username): void
    {
        $sql = "UPDATE tasks
                SET user_id = (SELECT id FROM users WHERE username = :username)
                WHERE id = :taskId
        ";

        $taskId = Uuid::fromString($taskId)->getBytes();

        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'taskId' => $taskId,
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
