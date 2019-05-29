<?php

namespace App\Interfaces\Web\Controller\Api;

use Auth0\SDK\Auth0;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Auth0Controller extends AbstractController
{
    /** @var Auth0  */
    protected $auth0;

    /** @var String */
    protected $token;

    /**
     * Auth0Controller constructor.
     *
     * @param Auth0 $auth0
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function __construct(Auth0 $auth0)
    {
        $this->auth0 = $auth0;
        $this->auth0->exchange();
    }

    /**
     * Method logs user and redirects
     */
    public function login(): void
    {
        $this->auth0->login();
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->auth0->logout();

        return $this->redirectToRoute('home');
    }

    /**
     * Route to get code needed to exchange for token
     *
     * @return RedirectResponse
     */
    public function callback(): RedirectResponse
    {
        return new RedirectResponse('/');
    }

    /**
     * @return JsonResponse
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function refreshToken(): JsonResponse
    {
        $this->auth0->renewTokens();
        $token = $this->auth0->getAccessToken();

        return new JsonResponse([
            'result' => 'Token has been refreshed',
            'token' => $token
        ], 200);
    }
}
