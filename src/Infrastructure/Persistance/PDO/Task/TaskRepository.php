<?php

namespace App\Infrastructure\Persistance\PDO\Task;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\Task\ValueObject\Title;
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
        $userIdBytes = null;
        if (!is_null($task->getAssignedUser())) {
            $userId = $task->getAssignedUser()->getId();
            $userIdBytes = $userId->getBytes();
        }

        $id = $task->getId()->getBytes();
        $data = [
            "id" => $id,
            "title" => $task->getTitle(),
            "status" => $task->getStatus(),
            "priority" => $task->getPriority()->getPriority(),
            "description" => $task->getDescription(),
            "created_at" => $task->getCreatedAt()->format('Y-m-d H:i:s'),
            "user_id" => $userIdBytes,
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `tasks` (`id`, `title`, `status`, `user_id`,`priority`, `description`, `created_at`) 
                    VALUES(:id, :title, :status, :user_id, :priority, :description, :created_at)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $this->pdo->commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $taskId
     * @throws NotFoundException
     */
    public function delete(string $taskId): void
    {
        $sql = "DELETE FROM `tasks` WHERE `id` = :id";
        $taskId = Uuid::fromString($taskId)->getBytes();

        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $taskId]);
        $result = $stmt->rowCount();
        if (!$result) {
            throw new NotFoundException("Task was not found.", 404);
        }

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

        $result = $stmt->rowCount();
        if (!$result) {
            throw new NotFoundException("Task was not found.", 404);
        }

        $this->pdo->commit();
    }

    /**
     * @param string $taskId
     * @param Status $status
     */
    public function changeStatus(string $taskId, Status $status): void
    {
        $sql = "UPDATE tasks
                SET status = :status
                WHERE id = :id
        ";
        $taskId = Uuid::fromString($taskId)->getBytes();
        $this->pdo->beginTransaction();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'status' => $status,
            'id' => $taskId,
        ]);
        $result = $stmt->rowCount();
        if (!$result) {
            throw new NotFoundException("Task was not found.", 404);
        }

        $this->pdo->commit();
    }

    /**
     * @param string $taskId
     * @return Task
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function getTaskByTaskId(string $taskId): Task
    {
        $taskIdBytes = Uuid::fromString($taskId)->getBytes();
        $sql = "SELECT * FROM tasks WHERE id LIKE :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $taskIdBytes]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException("Task was not found.", 404);
        }

        $id = Uuid::fromBytes($result['id']);

        $task = new Task(
            $id,
            new Title($result['title']),
            new Status($result['status']),
            null,
            new Priority($result['priority']),
            new Description($result['description']),
            $result['created_at']
        );

        return $task;
    }
}
