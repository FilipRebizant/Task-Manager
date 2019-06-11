<?php

namespace App\Interfaces\Web\Controller;

use App\Application\CommandBus;
use App\Application\CommandBusInterface;
use App\Application\Query\User\UserQueryInterface;
use App\Infrastructure\Persistance\PDO\User\UserQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
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
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig');
    }

    public function confirmRegistration(Request $request): Response
    {
        return $this->render('users/confirm_registration.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createPassword(Request $request): Response
    {


        return $this->redirectToRoute('home');
    }
}
