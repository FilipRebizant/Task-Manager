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
        $sql = "SELECT 
                description, status, priority, username 
                FROM tasks
                LEFT JOIN users
                ON tasks.id = users.id
                WHERE tasks.id = :id";

        $id = Uuid::fromString($taskId)->getBytes();

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        $result = $stmt->fetch();

        if (!$result) {
            throw new NotFoundException();
        }

        return new TaskView($result['description'], $result['status'], $result['priority'], $result['username']);
    }

    /**
     * @return array
     * @throws NotFoundException
     */
    public function getAll(): array
    {
        $sql = "SELECT title, status, priority, description, tasks.created_at, updated_at, username
                FROM tasks
                LEFT JOIN users
                ON tasks.user_id = users.id
                ";

        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException("No rows were found.");
        }

        return array_map(function (array $result) {
            return new TaskView(
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
