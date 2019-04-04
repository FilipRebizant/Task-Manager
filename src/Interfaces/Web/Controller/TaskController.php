<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\CreateNewTaskCommand;
use App\Application\CommandBus;
use App\Application\CommandBusInterface;
use App\Application\Handler\CreateNewTaskHandler;
use App\Domain\Task\TaskRepositoryInterface;
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
//    public function __construct()
//    {
//        $container = new Container();
//        $container['TaskRepositoryInterface'] = TaskRepositoryInterface::class;
//
//
////var_dump($container['TaskRepositoryInterface']);
//        $container['CommandBus'] = function ($c) {
//            $commandBus =  new CommandBus();
//            $handler = new CreateNewTaskHandler($c['TaskRepositoryInterface']);
//            $commandBus->registerHandler('CreateNewTaskCommand', $handler);
//            return $commandBus;
//        };
//        $this->commandBus = $container['CommandBus'];
//    }

    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
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
