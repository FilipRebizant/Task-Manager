<?php

namespace App\Infrastructure\Persistance\PDO;

use PDO;

class PDOConnector
{
    /** @var PDO */
    private $connection;

    /** @var array */
    private $settings;

    /**
     * PDOConnector constructor.
     */
    public function __construct()
    {
        $this->settings = [
            PDO::ATTR_DEFAULT_FETCH_MODE, 'FETCH_ASSOC',
        ];

        try {
            $this->connection = new PDO(
                'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME'),
                getenv('DB_USER'),
                getenv('DB_PASS'),
                $this->settings
            );
        } catch (\Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
