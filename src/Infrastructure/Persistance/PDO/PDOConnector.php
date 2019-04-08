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
                'mysql:host=172.19.0.2;dbname=db',
                'root',
                'password'
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