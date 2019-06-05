<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Query\User\UserQueryInterface;
use App\Infrastructure\Exception\NotFoundException;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /** @var JWTTokenManagerInterface  */
    private $jwtManager;

    /** @var UserQueryInterface  */
    private $userQuery;

    /**
     * SecurityController constructor.
     *
     * @param JWTTokenManagerInterface $jwtManager
     * @param UserQueryInterface $userQuery
     */
    public function __construct(JWTTokenManagerInterface $jwtManager, UserQueryInterface $userQuery)
    {
        $this->jwtManager = $jwtManager;
        $this->userQuery = $userQuery;
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

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function refreshToken(Request $request): JsonResponse
    {
        $session = $request->getSession();
        $username = $session->get('_security.last_username');

        try {
            $user = $this->userQuery->getSessionAuthUserByUsername($username);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                'error' => [
                    'message' => 'User was not found'
                ]
            ], 401);
        }

        $newToken = $this->jwtManager->create($user);
        $session->set('jwt_token', $newToken);

        return new JsonResponse([
            'result' => 'Token has been refreshed'
        ], 200);
    }
}
