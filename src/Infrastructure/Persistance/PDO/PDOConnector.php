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
        try {
            $this->connection = new PDO(
                'mysql:host=172.20.0.5;dbname=task-manager',
                'root',
                'password',
                [PDO::ATTR_DEFAULT_FETCH_MODE, 'FETCH_ASSOC']
            );
        } catch (\Exception $e){
            echo "Connection error: " . $e->getMessage();
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
