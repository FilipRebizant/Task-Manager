<?php

namespace App\Interfaces\Web\Controller;

use App\Infrastructure\Persistance\PDO\User\UserQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends AbstractController
{
    /** @var UserQuery */
    private $userQuery;

    /**
     * TaskController constructor.
     *
     * @param UserQuery $userQuery
     */
    public function __construct(UserQuery $userQuery)
    {
        $this->userQuery = $userQuery;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function index(Request $request): Response
    {
        $users = $this->userQuery->getAll();

        return $this->render('tasks/index.html.twig', ['users' => $users]);
    }
}
