<?php

namespace App\Infrastructure\Persistance\PDO\User;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Username;
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
     * @param PDOConnector $PDOConnector
     */
    public function __construct(PDOConnector $PDOConnector)
    {
        $this->pdo = $PDOConnector->getConnection();
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
            "activation_token" => Uuid::uuid4()->getBytes(),
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `users` (`id`, `username`, `email`, `created_at`, `activation_token`) 
                    VALUES(:id, :username, :email, :created_at, :activation_token)";
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
            throw new NotFoundException("User was not found");
        };
    }

    /**
     * @param string $username
     * @return User
     * @throws NotFoundException
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function getByUsername(string $username): User
    {
        $sql = "SELECT id, username, email, password 
                FROM users 
                WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException("User was not found");
        }

        $id = Uuid::fromBytes($result['id']);

        $user = new User(
            $id,
            new Username($result['username']),
            new Email($result['email']),
            array()
        );

        return $user;
    }

    /**
     * @param string $username
     * @return bool
     * @throws NotFoundException
     */
    public function checkIfUsernameExists(string $username): bool
    {
        $sql = "SELECT count('username') FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_COLUMN);

        if (!$result) {
            throw new NotFoundException("User was not found");
        }

        return true;
    }

    /**
     * @param string $email
     * @return bool
     * @throws NotFoundException
     */
    public function checkIfEmailExists(string $email): bool
    {
        $sql = "SELECT count('email') FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_COLUMN);

        if (!$result) {
            throw new NotFoundException("User was not found");
        }

        return true;
    }

    public function createPassword(string $userId, string $password): void
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $userId,
            'password' => $password,
        ]);

        $result = $stmt->fetch(PDO::FETCH_COLUMN);

        if (!$result) {
            throw new NotFoundException("User was not found");
        }
    }
}
