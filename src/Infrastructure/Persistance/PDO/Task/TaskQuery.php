<?php

namespace App\Infrastructure\Persistance\PDO\Task;

use App\Application\Query\Task\TaskQueryInterface;
use App\Application\Query\Task\TaskView;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
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
     * @param string $userId
     * @return TaskView
     * @throws NotFoundException
     */
    public function getById(string $userId): TaskView
    {
        $sql = "SELECT 
                description, status, priority, username 
                FROM tasks
                LEFT JOIN users
                ON tasks.id = users.id
                WHERE tasks.id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => Uuid::uuid4()->getBytes($userId)
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

        $sql = "SELECT UUID_SHORT(), user_id, title, description, status, priority, created_at, updated_at
                FROM tasks
                LEFT JOIN users
                ON tasks.id = users.id";

        $stmt = $this->pdo->query($sql);

//        $binary = $row['id'];
//        $string = unpack("H*", $binary);

//        $result = $stmt->fetchAll();
        $result = $stmt->fetchAll();

        if (!$result) {
            throw new NotFoundException("No rows were found.");
        }
        var_dump($result);
        return array_map(function (array $result) {
            return new TaskView($result['description'], $result['status'], $result['priority'], $result['user_id']);
        }, $result);
    }
}
