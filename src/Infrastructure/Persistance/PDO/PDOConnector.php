<?php

namespace App\Infrastructure\Persistance\PDO;

use PDO;

class PDOConnector
{
    /** @var PDO  */
    private $connection;

    /**
     * PDOConnector constructor.
     */
    public function __construct()
    {
        if (getenv('CI')) {
            try {
                $this->connection = new PDO(
                    'mysql:host=localhost;dbname=task-manager',
                    'root',
                    'new_password',
                    [PDO::ATTR_DEFAULT_FETCH_MODE, 'FETCH_ASSOC']
                );
            } catch (\Exception $e) {
                echo "Connection error: " . $e->getMessage();
            }
        } else {
            try {
                $this->connection = new PDO(
                    'mysql:host=172.20.0.5;dbname=task-manager',
                    'root',
                    'password',
                    [PDO::ATTR_DEFAULT_FETCH_MODE, 'FETCH_ASSOC']
                );
            } catch (\Exception $e) {
                echo "Connection error: " . $e->getMessage();
            }
        }
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
