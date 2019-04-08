<?php

use function DI\create;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\TaskRepository;
use App\Interfaces\Web\Controller\TaskController;
use Psr\Container\ContainerInterface;

return [
    'PDOConnector' =>  create(PDOConnector::class),

    'TaskRepository' => function(ContainerInterface $c) {
        return new TaskRepository($c->get('PDOConnector'));
    },
    'TaskController' => function(ContainerInterface $c) {
        return new TaskController($c->get('TaskRepository'));
    }
];