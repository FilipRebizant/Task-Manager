<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\CreateNewTaskCommand;
use App\Application\CommandBus;
use App\Application\CommandBusInterface;
use App\Application\Handler\CreateNewTaskHandler;
use App\Domain\Task\Task;
use App\Domain\Task\TaskRepositoryInterface;
use App\Infrastructure\Persistance\PDO\TaskRepository;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Polyfill\Ctype\Ctype;

class TaskController
{
    /** @var CommandBus  */
    private $commandBus;

    /**
     * TaskController constructor.
     * @param CommandBus $commandBus
     */
//    public function __construct()
//    {
//        $container = new Container();
//        $container['TaskRepositoryInterface'] = TaskRepositoryInterface::class;


//var_dump($container['TaskRepositoryInterface']);
//        $container['CommandBus'] = function ($c) {
//            $commandBus =  new CommandBus();
//            $handler = new CreateNewTaskHandler($c['TaskRepositoryInterface']);
//            $commandBus->registerHandler('CreateNewTaskCommand', $handler);
//            return $commandBus;
//        };
//        $this->commandBus = $container['CommandBus'];
//    }

    public function __construct()
    {
//        $this->commandBus = $commandBus;

            $this->commandBus = new CommandBus();
//            $this->commandBus->registerHandler();
    }

    /**
     * @param Request $request
     */
    public function createTask(Request $request)
    {
        $command = new CreateNewTaskCommand(
            (string) $request->get("status"),
            (int) $request->get("priority"),
            (string) $request->get("description")
        );

//        $this->commandBus->registerHandler($command, CreateNewTaskHandler::class);
//
        $taskRepository = new TaskRepository();
//        die();
//        var_dump($taskRepository);
        $taskRepository->create();
//        $handler = new CreateNewTaskHandler($taskRepository);
//        $this->commandBus->registerHandler($command, $handler);
//
//        $this->commandBus->handle($command);

        return new Response('ok');
    }

    public function home (Request $request)
    {
        return new Response('Home');
    }
}
