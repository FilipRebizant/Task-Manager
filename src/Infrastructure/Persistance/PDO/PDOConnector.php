<?php

namespace App\Infrastructure\Persistance\PDO;

use PDO;

class PDOConnector
{
    /** @var PDO  */
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
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
        ];

        if (getenv('CI')) {
            try {
                $this->connection = new PDO(
                    'mysql:host=localhost;dbname=task-manager',
                    'root',
                    'new_password',
                    $this->settings
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
                    $this->settings
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
