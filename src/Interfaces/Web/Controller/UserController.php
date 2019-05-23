<?php

namespace App\Interfaces\Web\Controller;

use App\Interfaces\Web\Controller\Api\AuthController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AuthController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Auth0\SDK\Exception\ApiException
     * @throws \Auth0\SDK\Exception\CoreException
     */
    public function index(Request $request)
    {
//        $token = $this->auth0->getIdToken();
//        var_dump($this->auth0->getUser());
//        $this->auth0->renewTokens();
//        $refresh = $this->auth0->getRefreshToken();
//        var_dump($refresh);
//        $token = $this->auth0->exchange();
//        $this->auth0->deleteAllPersistentData();
//        $this->auth0->
        $token = $this->auth0->getAccessToken();
        var_dump($token);
//        $token = $this->setCurrentToken($token);
        var_dump($token);


        return $this->render('users/index.html.twig', ['access_token' => $token]);
    }
}
