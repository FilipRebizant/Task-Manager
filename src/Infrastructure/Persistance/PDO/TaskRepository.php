<?php

namespace App\Infrastructure\Persistance\PDO;

use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use PDO;

class TaskRepository implements TaskRepositoryInterface
{
    /** @var PDO  */
    private $pdo;

    /**
     * TaskRepository constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDOConnector();
        $this->pdo = $this->pdo->getConnection();
    }

    /**
     * @param Task $task
     */
    public function create()
    {
        $data = [
            "description" => "dasdas"
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `tasks` (`desc`) VALUES(:description)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $this->pdo->commit();
            echo ' ok';

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
