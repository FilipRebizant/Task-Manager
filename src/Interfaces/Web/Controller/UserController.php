<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\DeleteUserCommand;
use App\Application\CommandBus;
use App\Application\CommandBusInterface;
use App\Application\Query\User\UserQueryInterface;
use App\Domain\User\User;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\PDOConnector;
use App\Infrastructure\Persistance\PDO\User\UserQuery;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    /** @var UserQuery */
    private $userQuery;

    /** @var CommandBus */
    private $commandBus;

    /**
     * UserController constructor.
     * @param CommandBusInterface $commandBus
     * @param UserQueryInterface $userQuery
     */
    public function __construct(CommandBusInterface $commandBus, UserQueryInterface $userQuery)
    {
        $this->commandBus = $commandBus;
        $this->userQuery = $userQuery;
    }

    public function createUser(Request $request): Response
    {
        $userRepository = new UserRepository(new PDOConnector());
        try {
//            $command = new CreateNewTaskCommand(
//                (string)$request->get("title"),
//                (int)$request->get("user_id"),
//                (string)$request->get("status"),
//                (int)$request->get("priority"),
//                (string)$request->get("description")
//            );
        $user = new User(
            Uuid::uuid4(),
            $request->get('username'), $request->get('email')
        );

        $userRepository->create($user);


        } catch (InvalidArgumentException $exception) {
            return new Response("Invalid argument passed", 400);
        }

        return new Response('User has been added.', 201);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function getUser(Request $request): Response
    {
        try {
            $user = $this->userQuery->getById($request->get('id'));
        } catch (NotFoundException $e) {
            return new Response("User was not found", 400);
        }

        return new Response(var_dump($user));
    }

    /**
     * @return Response
     */
    public function getUsers(): Response
    {
        try {
            $users = $this->userQuery->getAll();
        } catch (NotFoundException $e) {
            return new Response("Users were not found", 400);
        }

        return new Response(var_dump($users));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function deleteUser(Request $request): Response
    {
        try {
            $command = new DeleteUserCommand($request->get('id'));
            $this->commandBus->handle($command);
        } catch (NotFoundException $e) {
            return new Response("User was not found", 400);
        }

        return new Response("User has been deleted", 200);
    }
}
