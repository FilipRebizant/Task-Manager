<?php

namespace App\Infrastructure\Persistance\PDO\ActivationToken;

use App\Domain\ActivationToken\ActivationToken;
use App\Domain\ActivationToken\ActivationTokenRepositoryInterface;
use App\Domain\User\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use PDO;
use Ramsey\Uuid\Uuid;

class ActivationTokenRepository implements ActivationTokenRepositoryInterface
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
     * @param ActivationToken $token
     */
    public function create(ActivationToken $token): void
    {
        $data = [
            "id" => $token->getId()->getBytes(),
            "token" => $token->getToken(),
            "user_id" => $token->getUser()->getId()->getBytes(),
        ];

        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `activation_tokens` (
                     `id`,
                     `token`,
                     `user_id`
                     ) 
                    VALUES(:id, :token, :user_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            $this->pdo->commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $id
     * @return ActivationToken
     */
    public function getById(string $id): ActivationToken
    {
        $sql = "SELECT activation_tokens.id, token, username, email, role, activation_tokens.user_id
                FROM activation_tokens
                LEFT JOIN users ON users.id = activation_tokens.user_id
                WHERE activation_tokens.id = :id"
        ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => Uuid::fromString($id)->getBytes()]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new NotFoundException("Activation Token was not found");
        }

        $id = Uuid::fromBytes($result['id']);
        $user = new User(
            Uuid::fromBytes($result['user_id']),
            new Username($result['username']),
            new Email($result['email']),
            new Role($result['role']),
            []
        );

        $activationToken = new ActivationToken(
            $id,
            $user
        );

        return $activationToken;
    }

    /**
     * @param ActivationToken $token
     */
    public function activateAccount(ActivationToken $token): void
    {
        $sql = "UPDATE activation_tokens
                SET activated_at = now()
                WHERE token = :token";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'token' => $token->getToken(),
        ]);

        $result = $stmt->rowCount();

        if (!$result) {
            throw new NotFoundException("Activation token was not found");
        }
    }
}
