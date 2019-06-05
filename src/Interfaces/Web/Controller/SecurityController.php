<?php

namespace App\Interfaces\Web\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $jwtManager;
    private $security;


    public function __construct(JWTTokenManagerInterface $jwtManager, Security $security)
    {
        $this->jwtManager = $jwtManager;
        $this->security = $security;
    }

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    public function refreshToken(Request $request): JsonResponse
    {
//        $token = $this->jwtManager->create();
//        $token = $this->getService('lexik_jwt_authentication.encoder')
//            ->encode(['username' => 'weaverryan']);
        $token = $this->jwtManager->getUserIdentityField();
//        $this->jwtManager->create();
        $user1 = $this->security->getUser();
        $user2 = $this->getUser();
        $session = $request->getSession();
        var_dump($user1);
        var_dump($user2);
//        $this->
//        var_dump($request);
//        var_dump($request->getSession());
//        die;
        return new JsonResponse([

        ], 200);
    }
}
