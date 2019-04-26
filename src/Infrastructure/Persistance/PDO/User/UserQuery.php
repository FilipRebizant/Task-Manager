<?php

namespace App\Infrastructure\Persistance\PDO\User;

use App\Application\Query\User\UserQueryInterface;
use App\Application\Query\User\UserView;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use PDO;
use Ramsey\Uuid\Uuid;

class UserQuery implements UserQueryInterface
{
    /** @var PDOConnector */
    private $pdo;

    /**
     * UserQuery constructor.
     * @param PDOConnector $PDOConnector
     */
    public function __construct(PDOConnector $PDOConnector)
    {
        $this->pdo = $PDOConnector->getConnection();
    }

    /**
     * @param string $userId
     * @return UserView
     * @throws NotFoundException
     */
    public function getById(string $userId): UserView
    {
        $sql = "
            SELECT id, username, email, created_at
            FROM users
            WHERE users.id = :id
        ";

        /**
         * Query for user
         */
        $id = Uuid::fromString($userId)->getBytes();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        /**
         * Query for users tasks
         */
        $sqlTasks = "SELECT * FROM tasks WHERE user_id = :id";
        $tasksStmt = $this->pdo->prepare($sqlTasks);
        $tasksStmt->execute(['id' => $id]);
        $tasksResult = $tasksStmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException();
        }

        $id = Uuid::fromBytes($result['id']);

        return new UserView(
            $id,
            $result['username'],
            $result['email'],
            $result['created_at'],
            $tasksResult
        );
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $sql = "
            SELECT id, username, email, created_at
            FROM users
            GROUP BY username
        ";

        /**
         * Query for users
         */
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /**
         * Query for tasks
         */
        $sqlTasks = "SELECT * FROM tasks";
        $tasksStmt = $this->pdo->prepare($sqlTasks);
        $tasksStmt->execute();
        $tasksResults = $tasksStmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            throw new NotFoundException();
        }

        /**
         * Assign tasks to users
         */
        $users = [];
        foreach ($results as $result) {
            $userTasks = [];
            foreach ($tasksResults as $tasksResult) {
                if ($tasksResult['user_id'] == $result['id']) {
                    array_push($userTasks, $tasksResult);
                }
            }

            $user = new UserView(
                Uuid::fromBytes($result['id'])->toString(),
                $result['username'],
                $result['email'],
                $result['created_at'],
                $userTasks
            );
            array_push($users, $user);
        }

        return $users;
    }
}
