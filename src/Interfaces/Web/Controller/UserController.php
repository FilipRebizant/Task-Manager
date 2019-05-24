<?php

namespace App\Interfaces\Web\Controller;

use App\Interfaces\Web\Controller\Api\AuthController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AuthController
{
    /**
     * @param Request $request
     * @return Response
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function index(Request $request): Response
    {
        return $this->render('users/index.html.twig', ['access_token' => $this->auth0->getAccessToken()]);
    }
}
