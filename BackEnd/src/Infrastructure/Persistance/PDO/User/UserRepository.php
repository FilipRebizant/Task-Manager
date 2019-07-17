<?php

namespace App\Infrastructure\Persistance\PDO\User;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Role;
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
        $this->pdo = $PDOConnector->getPDO();
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
            "role" => $user->getRole(),
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `users` (
                     `id`,
                     `username`,
                     `password`,
                     `email`,
                     `created_at`,
                     `role`
                     ) 
                    VALUES(:id, :username, :password, :email, :created_at, :role)";
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
        $sql = "SELECT id, username, email, password, role
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
            new Role($result['role']),
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

    /**
     * @param string $userId
     * @param string $password
     * @throws NotFoundException
     */
    public function changePassword(string $userId, string $password): void
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $userId,
            'password' => $password,
        ]);

        $result = $stmt->rowCount();

        if (!$result) {
            throw new NotFoundException("User was not found");
        }
    }

    /**
     * @param string $activationToken
     * @throws NotFoundException
     */
    public function activateNewUser(string $activationToken, $password): void
    {
        $sql = "UPDATE users
                INNER JOIN activation_tokens ON users.id = activation_tokens.user_id
                SET password = :password 
                WHERE activation_tokens.token = :activation_token
                ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'activation_token' => $activationToken,
            'password' => $password
        ]);
        $result = $stmt->rowCount();

        if (!$result) {
            throw new NotFoundException("Activation token could't be found");
        }
    }
}
