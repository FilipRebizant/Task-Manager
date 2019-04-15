<?php

use App\Application\Query\User\UserQueryInterface;
use App\Domain\Task\TaskRepositoryInterface;
use App\Infrastructure\Persistance\PDO\User\UserQuery;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use function DI\create;
use App\Application\HandlerFactory;
use App\Infrastructure\Persistance\PDO\Task\TaskQuery;
use App\Infrastructure\Persistance\PDO\Task\TaskRepository;
use App\Application\NameInflector;
use App\Application\CommandBus;
use App\Application\Handler\CreateNewTaskHandler;
use App\Infrastructure\Persistance\PDO\PDOConnector;
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

    'UserRepository' => function(ContainerInterface $c) {
        return new UserRepository($c->get('PDOConnector'));
    },

    'CreateNewTaskHandler' => function(ContainerInterface $c) {
        return new CreateNewTaskHandler($c->get('TaskRepository'));
    },

    TaskRepositoryInterface::class => function(ContainerInterface $c) {
        return new TaskRepository($c->get('PDOConnector'));
    },

    'TaskController' => function(ContainerInterface $c) {
        return new TaskController($c->get('CommandBus'), $c->get('TaskQuery'));
    },

    UserQueryInterface::class => function(ContainerInterface $c) {
        return new UserQuery($c->get('PDOConnector'));
    }
];
