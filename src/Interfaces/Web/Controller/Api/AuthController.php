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
            'domain' => 'dev-gegxco2s.auth0.com', // getenv('DOMAIN')
            'client_id' => getenv('CLIENT_ID'),
            'client_secret' => getenv('CLIENT_SECRET'),
            'redirect_uri' => 'http://localhost/callback', // getenv('REDIRECT_URI')
            'audience' => 'http://localhost/api',
            'scope' => 'openid email offline_access read:users',
            'persist_id_token' => true,
            'persist_access_token' => true,
            'persist_refresh_token' => true,
        ]);
//        var_dump($this->auth0->getUser());
//        var_dump($this->auth0);
    }

    public function login()
    {
        $this->auth0->login();
    }

    public function logout(): RedirectResponse
    {
        $this->auth0->logout();

        return $this->redirectToRoute('home');
    }

    public function callback(Request $request)
    {
        var_dump($request);
        return new JsonResponse();
//        return new RedirectResponse('/');
    }

    public function authorize(Request $request): Response
    {
        return $this->render('auth/login.html.twig');
    }
}
