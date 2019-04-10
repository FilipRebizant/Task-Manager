<?php

use App\Application\HandlerFactory;
use function DI\create;
use App\Application\NameInflector;
use App\Application\CommandBus;
use App\Application\Handler\CreateNewTaskHandler;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\TaskRepository;
use App\Interfaces\Web\Controller\TaskController;
use Psr\Container\ContainerInterface;

return [
//    'PDOConnector' => create(PDOConnector::class),

//    'NameInflector' => create(NameInflector::class),

//    'HandlerFactory' => create(HandlerFactory::class),

//    'CommandBus' => function(ContainerInterface $c) {
//        return new CommandBus($c->get('InflectorInterface'));
//    },

//    'TaskRepository' => function(ContainerInterface $c) {
//        return new TaskRepository($c->get('PDOConnector'));
//    },
//
//    'CreateNewTaskHandler' => function(ContainerInterface $c) {
//        return new CreateNewTaskHandler($c->get('TaskRepository'));
//    },
//
//    'TaskRepositoryInterface' => function(ContainerInterface $c) {
//        return new TaskRepository($c->get('PDOConnector'));
//    },
//
//    'TaskController' => function(ContainerInterface $c) {
//        return new TaskController($c->get('CommandBus'));
//    },
];
