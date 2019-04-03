<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\CreateNewTaskCommand;
use App\Application\CommandBus;
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
    public function __construct(CommandBus $commandBus)
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
