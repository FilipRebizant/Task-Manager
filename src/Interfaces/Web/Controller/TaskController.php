<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\AssignUserToTaskCommand;
use App\Application\Command\ChangeTaskStatusCommand;
use App\Application\Command\CreateTaskCommand;
use App\Application\Command\DeleteTaskCommand;
use App\Application\CommandBus;
use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\Exception\InvalidStatusOrderException;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\Task\TaskQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController
{
    /** @var CommandBus */
    private $commandBus;

    /** @var */
    private $taskQuery;

    /**
     * TaskController constructor.
     *
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus, TaskQuery $taskQuery)
    {
        $this->commandBus = $commandBus;
        $this->taskQuery = $taskQuery;
    }

    /**
     * @return Response
     */
    public function getTasks(): Response
    {
        try {
            $tasksList = $this->taskQuery->getAll();
        } catch (NotFoundException $e) {
            return new Response($e->getMessage(), 400);
        }

        return new Response(var_dump($tasksList), 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getTask(Request $request): Response
    {
        try {
            $task = $this->taskQuery->getById($request->get('id'));
        } catch (NotFoundException $e) {
            return new Response("Task wasn't found", 400);
        }

        return new Response($task);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createTask(Request $request): Response
    {
        try {
            $command = new CreateTaskCommand(
                (string)$request->get("title"),
                (string)$request->get("username"),
                (string)$request->get("status"),
                (int)$request->get("priority"),
                (string)$request->get("description")
            );
            $this->commandBus->handle($command);
        } catch (InvalidArgumentException $exception) {
            return new Response("Invalid argument passed", 400);
        } catch (NotFoundException $exception) {
            return new Response("User was not found", 400);
        }

        return new Response('Task has been added.', 201);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function assignUserToTask(Request $request): Response
    {
        try {
            $command = new AssignUserToTaskCommand(
                $request->get('task_id'),
                $request->get('username')
            );
            $this->commandBus->handle($command);
        } catch (NotFoundException $e) {
            return new Response($e->getMessage(), 400);
        }

        return new Response("User has been assigned to task");
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function deleteTask(Request $request): Response
    {
        try {
            $command = new DeleteTaskCommand($request->get("id"));
            $this->commandBus->handle($command);
        } catch (\Exception $e) {
            return new Response($e->getMessage(), 400);
        }

        return new Response("Task has been removed", 202);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function changeStatus(Request $request): Response
    {
        try {
            $command = new ChangeTaskStatusCommand($request->get('taskId'), $request->get('status'));
            $this->commandBus->handle($command);
        } catch (InvalidStatusOrderException $exception) {
            return new Response("Invalid status order", 400);
        } catch (InvalidArgumentException $exception) {
            return new Response("Invalid status", 400);
        } catch (NotFoundException $exception) {
            return new Response("Task wasn't found", 400);
        }catch (\Exception $exception) {
            return new Response($exception);
        }

        return new Response("Status has been changed", 200);
    }
}
