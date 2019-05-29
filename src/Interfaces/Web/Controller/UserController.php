<?php

namespace App\Interfaces\Web\Controller;

use Auth0\SDK\Auth0;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /** @var Auth0  */
    private $auth0;

    /**
     * UserController constructor.
     *
     * @param Auth0 $auth0
     */
    public function __construct(Auth0 $auth0)
    {
        $this->auth0 = $auth0;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function index(Request $request): Response
    {
        return $this->render('users/index.html.twig',
            ['access_token' => $this->auth0->getAccessToken()]
        );
    }
}
