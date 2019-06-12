<?php

namespace App\Interfaces\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $roles = ['ADMIN', 'USER'];

        return $this->render('users/index.html.twig', ['roles' => $roles]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function loadConfirmRegistrationView(Request $request): Response
    {
        return $this->render('users/confirm_registration.html.twig');
    }
}
