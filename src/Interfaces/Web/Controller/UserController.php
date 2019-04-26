<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\CreateUserCommand;
use App\Application\Command\DeleteUserCommand;
use App\Application\CommandBus;
use App\Application\CommandBusInterface;
use App\Application\Query\User\UserQueryInterface;
use App\Domain\User\Exception\EmailAlreadyExistsException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Infrastructure\Exception\NotFoundException;
use App\Infrastructure\Persistance\PDO\User\UserQuery;
use InvalidArgumentException;
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
     * @return Response
     */
    public function createUser(Request $request): Response
    {
        try {
            $command = new CreateUserCommand(
                (string)$request->get("username"),
                (string)$request->get("password"),
                (string)$request->get("email")
            );
            $this->commandBus->handle($command);
        } catch (InvalidArgumentException $exception) {
            return new Response("Invalid argument passed", 400);
        } catch (UserAlreadyExistsException $exception) {
            return new Response("User already exists", 400);
        } catch (EmailAlreadyExistsException $exception) {
            return new Response("Email address is already taken", 400);
        } catch (\Exception $exception) {
            return new Response("An error occured", 500);
        }

        return new Response('User has been added', 201);
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
