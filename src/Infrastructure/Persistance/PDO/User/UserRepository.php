<?php

namespace App\Infrastructure\Persistance\PDO\User;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use PDO;
use Ramsey\Uuid\Uuid;

class UserRepository implements UserRepositoryInterface
{
    /** @var PDOConnector */
    private $pdo;

    /**
     * UserRepository constructor.
     * @param PDOConnector $pdo
     */
    public function __construct(PDOConnector $pdo)
    {
        $this->pdo = $pdo->getConnection();
    }

    /**
     * @param User $user
     */
    public function create(User $user): void
    {
        $data = [
            "id" => $user->getId()->getBytes(),
            "username" => $user->getUserName(),
            "email" => $user->getEmail(),
            "created_at" => $user->getCreatedAt()->format('Y-m-d H:i:s'),
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `users` (`id`, `username`, `email`, `created_at`) 
                    VALUES(:id, :username, :email, :created_at)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $this->pdo->commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $userId
     * @throws NotFoundException
     */
    public function delete(string $userId): void
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $id = Uuid::fromString($userId)->getBytes();
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        if ($stmt->rowCount() == 0) {
            throw new NotFoundException();
        };
    }

    /**
     * @param string $id
     * @return string
     */
    public function getUserByUsername(string $username): User
    {
        $sql = "SELECT id, username, email FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $id = Uuid::fromBytes($result['id']);

        $user = new User($id, $result['username'], $result['email']);

        return $user;
    }
}
