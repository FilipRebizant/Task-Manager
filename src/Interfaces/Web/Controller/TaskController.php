<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\CreateNewTaskCommand;
use App\Application\Contract\CommandBus;

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
     * @param $request
     */
    public function createTask($request)
    {
        $command = new CreateNewTaskCommand(
            (string) $request->post->get("status"),
            (int) $request->post->get("priority"),
            (string) $request->post->get("description")
        );

        $this->commandBus->handle($command);
    }
}
