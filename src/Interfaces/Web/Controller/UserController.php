<?php

namespace App\Interfaces\Web\Controller;

use App\Interfaces\Web\Controller\Api\Auth0Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Auth0Controller
{
    /**
     * @return Response
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', ['access_token' => $this->auth0->getAccessToken()]);
    }
}
