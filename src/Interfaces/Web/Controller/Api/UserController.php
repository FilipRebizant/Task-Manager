<?php

namespace App\Interfaces\Web\Controller\Api;

use App\Application\Command\CreateUserCommand;
use App\Application\Command\DeleteUserCommand;
use App\Application\CommandBus;
use App\Application\CommandBusInterface;
use App\Application\Query\User\UserQueryInterface;
use App\Domain\User\Exception\EmailAlreadyExistsException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\UserService;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\User\UserQuery;
use Auth0\SDK\Exception\InvalidTokenException;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController
{
    /** @var UserQuery */
    private $userQuery;

    /** @var CommandBus */
    private $commandBus;

    /** @var UserService  */
    private $userService;

    /**
     * UserController constructor.
     *
     * @param CommandBusInterface $commandBus
     * @param UserQueryInterface $userQuery
     * @param UserService $userService
     */
    public function __construct(CommandBusInterface $commandBus, UserQueryInterface $userQuery, UserService $usrService)
    {
        $this->commandBus = $commandBus;
        $this->userQuery = $userQuery;
        $this->userService = $usrService;
    }

    /**
     * @param Request $request
     * @return JsonResponse()
     */
    public function createUser(Request $request): JsonResponse
    {
        try {
            $command = new CreateUserCommand(
                (string)$request->get("username"),
                (string)$request->get("password"),
                (string)$request->get("email")
            );
            $this->commandBus->handle($command);
        } catch (InvalidArgumentException|UserAlreadyExistsException|EmailAlreadyExistsException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 400,
                    "message" => $e->getMessage(),
                ]
            ], 400);
        }

        return new JsonResponse(["result" => "User has been added"], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \ReflectionException
     */
    public function getUser(Request $request): JsonResponse
    {
        try {
            $user = $this->userQuery->getById($request->get('id'));
            $jsonUser = $this->userService->dismount($user);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ]
            ], 404);
        }

        return new JsonResponse($jsonUser, 200);
    }

    /**
     * @return JsonResponse
     * @throws \ReflectionException
     */
    public function getUsers(): JsonResponse
    {
        try {
            $users = $this->userQuery->getAll();
            $jsonUsersList = [];

            foreach ($users as $user) {
                array_push($jsonUsersList, $this->userService->dismount($user));
            }
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ]
            ], 404);
        }

        return new JsonResponse(["users" => $jsonUsersList], 200);
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
                ]
            ], 404);
        }

        return new JsonResponse(["result" => "User has been deleted"], 200);
    }
}
