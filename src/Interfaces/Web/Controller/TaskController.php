<?php

namespace App\Interfaces\Web\Controller;

use App\Infrastructure\Persistance\PDO\User\UserQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    /** @var UserQuery */
    private $userQuery;

    public function __construct(UserQuery $userQuery)
    {
        $this->userQuery = $userQuery;
    }

    public function index()
    {
        $users = $this->userQuery->getAll();

        var_dump($users);

        return $this->render('tasks/index.html.twig', ['users' => $users]);
    }
}
