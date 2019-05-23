<?php

namespace App\Interfaces\Web\Controller\Api;

use Auth0\SDK\Auth0;
use Auth0\SDK\JWTVerifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractController
{
    private $userInfo;

    protected $auth0;

    protected $token;
    protected $tokenInfo;

    public function __construct()
    {
        $this->auth0 = new Auth0([
            'domain' => 'dev-gegxco2s.auth0.com',
            'client_id' => getenv('CLIENT_ID'),
            'client_secret' => getenv('CLIENT_SECRET'),
            'redirect_uri' => 'http://localhost/callback',
            'audience' => 'http://localhost/api',
//            'audience' => 'https://dev-gegxco2s.auth0.com/userinfo',
            'scope' => 'openid offline_access',
            'persist_id_token' => true,
            'persist_access_token' => true,
            'persist_refresh_token' => true,
        ]);
//        var_dump($this->auth0);

        $this->userInfo = $this->auth0->getUser();
    }

    public function setCurrentToken($token)
    {
        try {
            $verifier = new JWTVerifier([
                'supported_algs' => ['RS256'],
                'valid_audiences' => ['http://localhost/api'],
                'authorized_iss' => ['https://dev-gegxco2s.auth0.com/'],
            ]);

            $this->token = $token;
            $this->tokenInfo = $verifier->verifyAndDecode($token);
        } catch (\Auth0\SDK\Exception\CoreException $e) {
            throw $e;
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getToken(Request $request): JsonResponse
    {
        return new JsonResponse([
            'client_id' => getenv('CLIENT_ID'),
            'client_secret' => getenv('CLIENT_SECRET'),
        ], 200);
    }

    public function login(Request $request)
    {
        $this->auth0->logout();
        $this->auth0->login();
    }

    public function callback(Request $request): Response
    {
        return new RedirectResponse('/');
    }

    public function authorize(Request $request): Response
    {
        return $this->render('auth/login.html.twig');
    }
}
