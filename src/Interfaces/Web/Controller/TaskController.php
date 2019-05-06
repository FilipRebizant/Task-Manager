<?php

namespace App\Interfaces\Web\Controller;

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
     * @throws \ReflectionException
     */
    public function getTasks(): JsonResponse
    {
        try {
            $tasksList = $this->taskQuery->getAll();
            $jsonTasksList = [];
            $taskService = new TaskService();

            foreach ($tasksList as $task) {
                array_push($jsonTasksList, $taskService->dismount($task));
            }
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse(["tasks" => $jsonTasksList], 200);
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
            $taskService = new TaskService();
            $jsonTask = $taskService->dismount($task);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "message" => "Task wasn't found.",
                ],
            ], 404);
        }

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
            return new JsonResponse(["error" => "Invalid argument passed"], 400);
        } catch (NotFoundException $exception) {
            return new JsonResponse(["error" => "User was not found"], 404);
        }

        return new JsonResponse('Task has been created.', 201);
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
            return new JsonResponse("Task wasn't found", 404);
        } catch (\Exception $exception) {
            return new JsonResponse($exception);
        }

        return new JsonResponse("Status has been changed", 200);
    }
}
