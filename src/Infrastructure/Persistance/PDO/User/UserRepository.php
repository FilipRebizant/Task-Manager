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
            "password" => $user->getPassword(),
            "email" => $user->getEmail(),
            "created_at" => $user->getCreatedAt()->format('Y-m-d H:i:s'),
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) 
                    VALUES(:id, :username, :password, :email, :created_at)";
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
     * @param string $username
     * @return User
     * @throws NotFoundException
     * @throws \App\Domain\User\Exception\InvalidEmailException
     * @throws \App\Domain\User\Exception\InvalidPasswordException
     * @throws \App\Domain\User\Exception\InvalidUsernameException
     */
    public function getUserByUsername(string $username): User
    {
        $sql = "SELECT id, username, email, password FROM users WHERE username LIKE :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException();
        }

        $id = Uuid::fromBytes($result['id']);

        $user = new User(
            $id,
            new Username($result['username']),
            new Password($result['password']),
            new Email($result['email']),
            array()
        );

        return $user;
    }

    /**
     * @param string $email
     * @return User
     * @throws NotFoundException
     * @throws \App\Domain\User\Exception\InvalidEmailException
     * @throws \App\Domain\User\Exception\InvalidPasswordException
     * @throws \App\Domain\User\Exception\InvalidUsernameException
     */
    public function getUserByEmail(string $email): User
    {
        $sql = "SELECT id, username, email, password FROM users WHERE email LIKE :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException();
        }

        $id = Uuid::fromBytes($result['id']);

        $user = new User(
            $id,
            new Username($result['username']),
            new Password($result['password']),
            new Email($result['email']),
            array()
        );

        return $user;
    }
}
