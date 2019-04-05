<?php

namespace App\Infrastructure\Persistance\PDO;

use PDO;

class PDOConnector
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=172.19.0.3;dbname=db',
                'root',
                'password'
            );
        } catch (\Exception $e){
            echo "Connection error: " . $e->getMessage();
        }
    }


    public function getConnection()
    {
        return $this->connection;
    }
}
