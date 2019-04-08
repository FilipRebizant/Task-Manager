<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\CreateNewTaskCommand;
use App\Application\CommandBus;
use App\Application\Handler\CreateNewTaskHandler;
use App\Infrastructure\Persistance\PDO\TaskRepository;
use InvalidArgumentException;
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
     * @return Response
     * @throws \Exception
     */
    public function createTask(Request $request)
    {
        $command = new CreateNewTaskCommand(
            (string) $request->get("status"),
            (int) $request->get("priority"),
            (string) $request->get("description")
        );

        try {
            $handler = new CreateNewTaskHandler($this->taskRepository);
            $handler->handle($command);

        } catch (InvalidArgumentException $exception) {
            return new Response("Invalid argument passed", 400);
        }

        return new Response('Task has been added.', 201);
    }
}
