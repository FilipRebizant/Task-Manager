<?php

namespace App\Interfaces\Web\Controller;

use App\Domain\User\User;
use App\Infrastructure\Persistance\PDO\User\UserRepository;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(Request $request): Response
    {
        try {
//            $command = new CreateNewTaskCommand(
//                (string)$request->get("title"),
//                (int)$request->get("user_id"),
//                (string)$request->get("status"),
//                (int)$request->get("priority"),
//                (string)$request->get("description")
//            );
        $user = new User(
            $request->get('username'), $request->get('email')
        );

        $this->userRepository->create($user);


        } catch (InvalidArgumentException $exception) {
            return new Response("Invalid argument passed", 400);
        }

        return new Response('User has been added.', 201);
    }
}
