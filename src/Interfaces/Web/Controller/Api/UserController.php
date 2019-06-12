<?php

namespace App\Interfaces\Web\Controller\Api;

use App\Application\Command\CreatePasswordCommand;
use App\Application\Command\CreateUserCommand;
use App\Application\Command\DeleteUserCommand;
use App\Application\CommandBus;
use App\Application\CommandBusInterface;
use App\Application\Query\User\UserQueryInterface;
use App\Application\Query\User\UserView;
use App\Domain\Exception\InvalidArgumentException;
use App\Domain\User\Exception\EmailAlreadyExistsException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\User\UserQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    /** @var UserQuery */
    private $userQuery;

    /** @var CommandBus */
    private $commandBus;

    /**
     * UserController constructor.
     *
     * @param CommandBusInterface $commandBus
     * @param UserQueryInterface $userQuery
     */
    public function __construct(CommandBusInterface $commandBus, UserQueryInterface $userQuery)
    {
        $this->commandBus = $commandBus;
        $this->userQuery = $userQuery;
    }

    /**
     * @param Request $request
     * @return JsonResponse()
     */
    public function createUser(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            $command = new CreateUserCommand(
                (string)$data["username"],
                (string)$data["email"],
                (string)$data["role"]
            );
            $this->commandBus->handle($command);
        } catch (InvalidArgumentException|UserAlreadyExistsException|EmailAlreadyExistsException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 400,
                    "message" => $e->getMessage(),
                ],
            ], 400);
        }

        return new JsonResponse(["result" => "User has been added"], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUser(Request $request): JsonResponse
    {
        try {
            $user = $this->userQuery->getById($request->get('id'));
            $userArray = $user->toArray();
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse($userArray, 200);
    }

    /**
     * @return JsonResponse
     * @throws \ReflectionException
     */
    public function getUsers(): JsonResponse
    {
        try {
            $users = $this->userQuery->getAll();
            $usersList = [];

            /** @var UserView $user */
            foreach ($users as $user) {
                array_push($usersList, ($user->toArray()));
            }
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse(["users" => $usersList], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse()
     */
    public function deleteUser(Request $request): JsonResponse
    {
        try {
            $command = new DeleteUserCommand($request->get('id'));
            $this->commandBus->handle($command);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse(["result" => "User has been deleted"], 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createPassword(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $command = new CreatePasswordCommand(
                (string)$data["password1"],
                (string)$data["password2"]
            );

            $this->commandBus->handle($command);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ],
            ], 404);
        }

        return new JsonResponse(["result" => "Password has been created"], 200);
    }
}
