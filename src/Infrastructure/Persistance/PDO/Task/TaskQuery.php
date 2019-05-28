<?php

namespace App\Infrastructure\Persistance\PDO\Task;

use App\Application\Query\Task\TaskQueryInterface;
use App\Application\Query\Task\TaskView;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use PDO;
use Ramsey\Uuid\Uuid;

class TaskQuery implements TaskQueryInterface
{
    /** @var PDOConnector */
    private $pdo;

    /**
     * TaskQuery constructor.
     *
     * @param PDOConnector $pdo
     */
    public function __construct(PDOConnector $PDOConnector)
    {
        $this->pdo = $PDOConnector->getConnection();
    }

    /**
     * @param string $taskId
     * @return TaskView
     * @throws NotFoundException
     */
    public function getById(string $taskId): TaskView
    {
        $sql = "SELECT tasks.id as id, title, status, priority, description, tasks.created_at, updated_at, username
                FROM tasks
                LEFT JOIN users
                ON tasks.user_id = users.id
                WHERE tasks.id = :id
                ";

        $idString = Uuid::fromString($taskId);
        $idBytes = $idString->getBytes();

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $idBytes,
        ]);
        $result = $stmt->fetch();

        if (!$result) {
            throw new NotFoundException("Task was not found.");
        }

        $updatedAt = is_null($result['updated_at']) ? '' : $result['updated_at'];

        return new TaskView(
            $idString,
            $result['title'],
            $result['status'],
            $result['username'],
            $result['priority'],
            $result['description'],
            $result['created_at'],
            $updatedAt
        );
    }

    /**0
     * @return array
     * @throws NotFoundException
     */
    public function getAll(): array
    {
        $sql = "SELECT tasks.id as id, title, status, priority, description, tasks.created_at, updated_at, username
                FROM tasks
                LEFT JOIN users
                ON tasks.user_id = users.id
                ORDER BY created_at DESC
                ";

        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException("No tasks were found.");
        }

        return array_map(function (array $result) {
            return new TaskView(
                Uuid::fromBytes($result['id'])->toString(),
                $result['title'],
                $result['status'],
                $result['username'],
                $result['priority'],
                $result['description'],
                $result['created_at'],
                $result['updated_at']
            );
        }, $result);
    }

    /**
     * @param string $status
     * @return array
     */
    public function getAllByStatus(string $status): array
    {
        $sql = "SELECT tasks.id as id, title, status, priority, description, tasks.created_at, updated_at, username
                FROM tasks
                LEFT JOIN users
                ON tasks.user_id = users.id
                WHERE tasks.status = :status
                ORDER BY created_at DESC
                ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['status' => $status]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            return array();
        }

        return array_map(function (array $result) {
            return new TaskView(
                Uuid::fromBytes($result['id'])->toString(),
                $result['title'],
                $result['status'],
                $result['username'],
                $result['priority'],
                $result['description'],
                $result['created_at'],
                $result['updated_at']
            );
        }, $result);
    }
}
