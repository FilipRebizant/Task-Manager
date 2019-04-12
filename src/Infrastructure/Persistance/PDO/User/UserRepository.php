<?php

namespace App\Infrastructure\Persistance\PDO\User;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;

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
    public function create(User $user)
    {
        $data = [
            "id" => $user->getId()->getBytes(),
            "username" => $user->getUserName(),
            "email" => $user->getEmail(),
            "created_at" => $user->getCreatedAt()->format('Y-m-d H:i:s'),
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `users` (`id`, `username`, `email`, `created_at`) VALUES(:id, :username, :email, :created_at)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);

            $this->pdo->commit();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param User $user
     */
    public function delete(User $user)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param int $id
     * @return User
     */
    public function getById(int $id): User
    {
        $sql = "SELECT username, email FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        if (!$result) {
            throw new NotFoundException();
        }

        return new User($result['username'], $result['email']);
    }
}