<?php

use function DI\create;
use App\Application\HandlerFactory;
use App\Infrastructure\Persistance\PDO\TaskQuery;
use App\Application\NameInflector;
use App\Application\CommandBus;
use App\Application\Handler\CreateNewTaskHandler;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\TaskRepository;
use App\Interfaces\Web\Controller\TaskController;
use Psr\Container\ContainerInterface;

return [
    'PDOConnector' => create(PDOConnector::class),

    'NameInflector' => create(NameInflector::class),

    'HandlerFactory' => create(HandlerFactory::class),

    'TaskQuery' => function(ContainerInterface $c) {
        return new TaskQuery($c->get('PDOConnector'));
    },

    'CommandBus' => function(ContainerInterface $c) {
        return new CommandBus($c->get('NameInflector'), $c->get('HandlerFactory'));
    },

    'TaskRepository' => function(ContainerInterface $c) {
        return new TaskRepository($c->get('PDOConnector'));
    },

    'CreateNewTaskHandler' => function(ContainerInterface $c) {
        return new CreateNewTaskHandler($c->get('TaskRepository'));
    },

    'TaskRepositoryInterface' => function(ContainerInterface $c) {
        return new TaskRepository($c->get('PDOConnector'));
    },

    'TaskController' => function(ContainerInterface $c) {
        return new TaskController($c->get('CommandBus'), $c->get('TaskQuery'));
    },
];
