<?php

namespace App\Interfaces\Web\Controller\Api;

use Auth0\SDK\Auth0;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractController
{
    protected $auth0;

    protected $token;

    protected $tokenInfo;

    public function __construct()
    {
        $this->auth0 = new Auth0([
            'domain' => getenv('DOMAIN'),
            'client_id' => getenv('CLIENT_ID'),
            'client_secret' => getenv('CLIENT_SECRET'),
            'redirect_uri' => getenv('REDIRECT_URI'),
            'audience' => 'http://localhost/api',
            'scope' => 'openid offline_access read:users',
            'persist_id_token' => true,
            'persist_access_token' => true,
            'persist_refresh_token' => true,
        ]);

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
     * @param Request $request
     * @return Response
     */
    public function authorize(Request $request): Response
    {
        return $this->render('auth/login.html.twig');
    }

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
