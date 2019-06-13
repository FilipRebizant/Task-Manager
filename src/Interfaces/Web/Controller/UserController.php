<?php

namespace App\Interfaces\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function loadConfirmRegistrationView(Request $request): Response
    {
        return $this->render('users/confirm_registration.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function showProfile(Request $request): Response
    {
        return $this->render('users/profile.html.twig');
    }
}
