<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\CreateNewTaskCommand;
use App\Application\CommandBus;
use App\Application\Handler\CreateNewTaskHandler;
use App\Domain\Task\TaskRepository;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController
{
    /** @var CommandBus  */
    private $commandBus;

    /**
     * TaskController constructor.
     * @param CommandBus $commandBus
     */
    public function __construct()
    {
        $container = new Container();
//        $container['TaskRepository'] = TaskRepository::class;

        $container['TaskRepository'] = $container->factory(function ($c) {
           return
        });
//var_dump($container['TaskRepository']);
        $container['CommandBus'] = function ($c) {
            $commandBus =  new CommandBus();
            $handler = new CreateNewTaskHandler($c['TaskRepository']);
            $commandBus->registerHandler('CreateNewTaskCommand', $handler);
            return $commandBus;
        };
        $this->commandBus = $container['CommandBus'];
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

        $this->commandBus->handle($command);

        return new Response('ok');
    }

    public function home (Request $request)
    {
        return new Response('Home');
    }
}
