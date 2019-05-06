<?php

namespace App\Interfaces\Web\Controller;

use App\Application\AbstractService;
use App\Application\Command\AssignUserToTaskCommand;
use App\Application\Command\ChangeTaskStatusCommand;
use App\Application\Command\CreateTaskCommand;
use App\Application\Command\DeleteTaskCommand;
use App\Application\CommandBus;
use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\Exception\InvalidStatusOrderException;
use App\Domain\TaskService;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\Task\TaskQuery;
use ReflectionClass;
use Symfony\Component\HttpFoundation\JsonJsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @return JsonResponse
     */
    public function getTasks(): JsonResponse
    {
        try {
            $tasksList = $this->taskQuery->getAll();
        } catch (NotFoundException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }

        return new JsonResponse(var_dump($tasksList), 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \ReflectionException
     */
    public function getTask(Request $request): JsonResponse
    {
        try {
            $task = $this->taskQuery->getById($request->get('id'));
        } catch (NotFoundException $e) {
            return new JsonResponse(["error" => "Task wasn't found"], 400);
        }

        $taskService = new TaskService();
        $jsonTask = $taskService->dismount($task);

        return new JsonResponse($jsonTask, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createTask(Request $request): JsonResponse
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
            return new JsonResponse("Invalid argument passed", 400);
        } catch (NotFoundException $exception) {
            return new JsonResponse("User was not found", 400);
        }

        return new JsonResponse('Task has been added.', 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function assignUserToTask(Request $request): JsonResponse
    {
        try {
            $command = new AssignUserToTaskCommand(
                $request->get('task_id'),
                $request->get('username')
            );
            $this->commandBus->handle($command);
        } catch (NotFoundException $e) {
            return new JsonResponse($e->getMessage(), 400);
        }

        return new JsonResponse("User has been assigned to task");
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteTask(Request $request): JsonResponse
    {
        try {
            $command = new DeleteTaskCommand($request->get("id"));
            $this->commandBus->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse($e->getMessage(), 400);
        }

        return new JsonResponse("Task has been removed", 202);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatus(Request $request): JsonResponse
    {
        try {
            $command = new ChangeTaskStatusCommand($request->get('taskId'), $request->get('status'));
            $this->commandBus->handle($command);
        } catch (InvalidStatusOrderException $exception) {
            return new JsonResponse("Invalid status order", 400);
        } catch (InvalidArgumentException $exception) {
            return new JsonResponse("Invalid status", 400);
        } catch (NotFoundException $exception) {
            return new JsonResponse("Task wasn't found", 400);
        } catch (\Exception $exception) {
            return new JsonResponse($exception);
        }

        return new JsonResponse("Status has been changed", 200);
    }
}
