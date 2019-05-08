<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\AssignUserToTaskCommand;
use App\Application\Command\ChangeTaskStatusCommand;
use App\Application\Command\CreateTaskCommand;
use App\Application\Command\DeleteTaskCommand;
use App\Application\CommandBus;
use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\Exception\InvalidStatusOrderException;
use App\Domain\Task\TaskService;
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
                    "status" => 404,
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
                    "status" => 404,
                    "message" => $e->getMessage(),
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
        } catch (InvalidArgumentException|NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => $e->getCode(),
                    "message" => $e->getMessage(),
                ],
            ], $e->getCode());
        }

        return new JsonResponse(['result' => 'Task has been created.'], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function assignTaskToUser(Request $request): JsonResponse
    {
        try {
            $command = new AssignUserToTaskCommand(
                $request->get('id'),
                $request->get('username')
            );
            $this->commandBus->handle($command);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => $e->getCode(),
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse(["result" => "User has been assigned"], 200);
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
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => $e->getCode(),
                    "message" => $e->getMessage(),
                ],
            ], $e->getCode());
        }

        return new JsonResponse(["response" => "Task has been deleted."], 200);
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
        } catch (InvalidStatusOrderException|InvalidArgumentException|NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => $e->getCode(),
                    "message" => $e->getMessage(),
                ],
            ], $e->getCode());
        }

        return new JsonResponse(null, 200);
    }
}
