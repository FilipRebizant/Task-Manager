<?php

namespace App\Interfaces\Web\Controller;

use App\Interfaces\Web\Controller\Api\AuthController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AuthController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function index(Request $request): Response
    {
        try {
            $user = $this->auth0->getUser();
            var_dump($user);
            $token = $this->auth0->getAccessToken();
            var_dump($token);

            return $this->render('users/index.html.twig', ['access_token' => $token]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e], 400);
        }

    }
}
