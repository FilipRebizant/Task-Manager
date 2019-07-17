<?php

namespace App\Interfaces\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('admin_panel/index.html.twig');
    }

    /**
     * @return Response
     */
    public function usersIndex(): Response
    {
        $roles = ['ADMIN', 'USER'];

        return $this->render('users/index.html.twig', ['roles' => $roles]);
    }
}
