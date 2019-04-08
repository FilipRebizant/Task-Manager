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

class TaskController
{
    /** @var CommandBus  */
    private $commandBus;

    /** @var TaskRepository  */
    private $taskRepository;

    /**
     * TaskController constructor.
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param Request $request
     */
    public function createTask(Request $request)
    {
//        $command = new CreateNewTaskCommand(
//            (string) $request->get("status"),
//            (int) $request->get("priority"),
//            (string) $request->get("description")
//        );
        $command = new CreateNewTaskCommand(
            "Todo",
            1,
            "Description"
        );

//        $taskRepository = new TaskRepository();

        $handler = new CreateNewTaskHandler($this->taskRepository);
        $bus = new CommandBus();
//        $bus->registerHandler('CreateNewTaskCommand', $handler);

//        var_dump($bus);
//
//        $this->commandBus->handle($command);
        $handler->handle($command);
        return new Response('ok');
    }

    public function home (Request $request)
    {
        return new Response('Home');
    }
}
