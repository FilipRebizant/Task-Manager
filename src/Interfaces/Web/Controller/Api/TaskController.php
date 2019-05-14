<?php

namespace App\Interfaces\Web\Controller\Api;

use App\Application\Command\AssignTaskToUserCommand;
use App\Application\Command\ChangeTaskStatusCommand;
use App\Application\Command\CreateTaskCommand;
use App\Application\Command\DeleteTaskCommand;
use App\Application\CommandBusInterface;
use App\Application\Query\Task\TaskQueryInterface;
use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\Exception\InvalidStatusOrderException;
use App\Domain\Task\Exception\UserAlreadyAssignedException;
use App\Domain\Task\TaskService;
use App\Infrastructure\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskController
{
    /** @var CommandBusInterface */
    private $commandBus;

    /** @var TaskQueryInterface*/
    private $taskQuery;

    /** @var TaskService  */
    private $taskService;

    /**
     * TaskController constructor.
     *
     * @param CommandBusInterface $commandBus
     * @param TaskQueryInterface $taskQuery
     * @param TaskService $taskService
     *
     */
    public function __construct(CommandBusInterface $commandBus, TaskQueryInterface $taskQuery, TaskService $taskService)
    {
        $this->commandBus = $commandBus;
        $this->taskQuery = $taskQuery;
        $this->taskService = $taskService;
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

            foreach ($tasksList as $task) {
                array_push($jsonTasksList, $this->taskService->dismount($task));
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
            $jsonTask = $this->taskService->dismount($task);
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
        } catch (InvalidArgumentException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 400,
                    "message" => $e->getMessage(),
                ],
            ], 400);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse(['result' => 'Task has been created'], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function assignTaskToUser(Request $request): JsonResponse
    {
        try {
            $command = new AssignTaskToUserCommand(
                $request->get('id'),
                $request->get('username')
            );
            $this->commandBus->handle($command);
        } catch (UserAlreadyAssignedException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 400,
                    "message" => $e->getMessage(),
                ],
            ], 400);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
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
                    "status" => 404,
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse(["response" => "Task has been deleted"], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatus(Request $request): JsonResponse
    {
        try {
            $command = new ChangeTaskStatusCommand($request->get('id'), $request->get('status'));
            $this->commandBus->handle($command);
        } catch (InvalidStatusOrderException|InvalidArgumentException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 400,
                    "message" => $e->getMessage(),
                ],
            ], 400);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse(["response" => "Status has been changed"], 200);
    }
}
