<?php

namespace App\Infrastructure\Persistance\PDO\User;

use App\Application\Query\Task\TaskView;
use App\Application\Query\User\UserQueryInterface;
use App\Application\Query\User\UserView;
use App\Domain\Security\Symfony\User\SecurityUser;
use App\Domain\User\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Username;
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
            throw new NotFoundException("User was not found.");
        }

        $id = Uuid::fromBytes($result['id']);

        $userTasks = [];
        foreach ($tasksResult as $taskResult) {
                $id = Uuid::fromBytes($taskResult['id']);
                $usrId = Uuid::fromBytes($taskResult['user_id']);
                $task = new TaskView(
                    $id,
                    $taskResult['title'],
                    $taskResult['status'],
                    $usrId,
                    $taskResult['priority'],
                    $taskResult['description'],
                    $taskResult['created_at'],
                    $taskResult['updated_at']
                );
                array_push($userTasks, $task);
        }

        return new UserView(
            $id,
            $result['username'],
            $result['email'],
            $result['created_at'],
            $userTasks
        );
    }

    /**
     * @return array
     * @throws NotFoundException
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
            throw new NotFoundException("Users were not found.");
        }

        /**
         * Assign tasks to users
         */
        $users = [];
        foreach ($results as $result) {
            $userTasks = [];
            foreach ($tasksResults as $tasksResult) {
                if ($tasksResult['user_id'] == $result['id']) {
                    $id = Uuid::fromBytes($tasksResult['id']);
                    $userId = Uuid::fromBytes($tasksResult['user_id']);
                    $task = new TaskView(
                        $id,
                        $tasksResult['title'],
                        $tasksResult['status'],
                        $userId,
                        $tasksResult['priority'],
                        $tasksResult['description'],
                        $tasksResult['created_at'],
                        $tasksResult['updated_at']
                    );
                    array_push($userTasks, $task);
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

    /**
     * @param string $email
     * @return SecurityUser
     * @throws NotFoundException
     */
    public function getSecurityUserByEmail(string $email): SecurityUser
    {
        $sql = "SELECT id, username, email, password 
                FROM users 
                WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException("User was not found.");
        }

        $user = new SecurityUser(
            $result['username'],
            $result['password']
        );

        return $user;
    }

    /**
     * @param string $username
     * @return SecurityUser
     * @throws NotFoundException
     */
    public function getSecurityUserByUsername(string $username): SecurityUser
    {
        $sql = "
                SELECT username, password 
                FROM users 
                WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException("User was not found.");
        }

        $user = new SecurityUser(
            $result['username'],
            $result['password']
        );

        return $user;
    }
}
