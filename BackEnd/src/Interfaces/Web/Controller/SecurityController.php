<?php

namespace App\Interfaces\Web\Controller;

use App\Application\Command\ActivateAccountCommand;
use App\Application\Command\ChangePasswordCommand;
use App\Application\CommandBusInterface;
use App\Application\Query\User\UserQueryInterface;
use App\Domain\Exception\InvalidArgumentException;
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

    /** @var CommandBusInterface */
    private $commandBus;

    /**
     * SecurityController constructor.
     *
     * @param JWTTokenManagerInterface $jwtManager
     * @param UserQueryInterface $userQuery
     */
    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        UserQueryInterface $userQuery,
        CommandBusInterface $commandBus
    ) {
        $this->commandBus = $commandBus;
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
        $data = json_decode($request->getContent(), true);
        if ($data['username']) {
            $username = $data['username'];
        }

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
            'result' => 'Token has been refreshed',
            'token' => $newToken,
        ], 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function activateAccount(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $command = new ActivateAccountCommand(
                (string)$request->get('token'),
                (string)$data["password1"],
                (string)$data["password2"]
            );

            $this->commandBus->handle($command);
        } catch (NotFoundException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 404,
                    "message" => $e->getMessage(),
                ],
            ], 404);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse([
                "error" => [
                    "status" => 400,
                    "message" => $e->getMessage(),
                ],
            ], 400);
        }

        return new JsonResponse(["result" => "Account had been activated"], 200);
    }
}
