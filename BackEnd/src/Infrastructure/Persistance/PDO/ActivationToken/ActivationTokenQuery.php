<?php

namespace App\Infrastructure\Persistance\PDO\ActivationToken;

use App\Application\Query\ActivationToken\ActivationTokenView;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use PDO;
use Ramsey\Uuid\Uuid;

class ActivationTokenQuery
{
    /** @var PDOConnector */
    private $pdo;

    /**
     * UserQuery constructor.
     * @param PDOConnector $PDOConnector
     */
    public function __construct(PDOConnector $PDOConnector)
    {
        $this->pdo = $PDOConnector->getPDO();
    }

    /**
     * @param string $id
     * @return ActivationTokenView
     * @throws NotFoundException
     */
    public function getById(string $id): ActivationTokenView
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

        $id = Uuid::fromBytes($result['id'])->toString();

        $activationTokenView = new ActivationTokenView(
            $id,
            $result['token'],
            $result['username'],
            $result['created_at'],
            $result['updated_at']
        );

        return $activationTokenView;
    }
}
