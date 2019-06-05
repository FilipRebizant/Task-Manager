<?php

declare(strict_types=1);

namespace App\Domain\Security\Symfony\TokenAuth;

use App\Application\Query\User\UserQueryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
    /** @var UserQueryInterface  */
    private $userQuery;

    private $security;

    /**
     * TokenAuthenticator constructor.
     *
     * @param UserQueryInterface $userQuery
     */
    public function __construct(Security $security)
    {
//        $this->userQuery = $userQuery;
        $this->security = $security;
    }

    /**
     * Returns a response that directs the user to authenticate.
     *
     * This is called when an anonymous request accesses a resource that
     * requires authentication. The job of this method is to return some
     * response that "helps" the user start into the authentication process.
     *
     * Examples:
     *
     * - For a form login, you might redirect to the login page
     *
     *     return new RedirectResponse('/login');
     *
     * - For an API token authentication system, you return a 401 response
     *
     *     return new Response('Auth header required', 401);
     *
     * @param Request $request The request that resulted in an AuthenticationException
     * @param AuthenticationException $authException The exception that started the authentication process
     *
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse([
            'error' => [
                'message' => 'Auth required',
            ]
        ], 401);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request): bool
    {
//        $token = new JWTUser->
//        var_dump($this->createAuthenticatedToken());
//        var_dump($request->getUser());
//        var_dump($this->getCredentials($request));
//        die;
//        var_dump($request->headers);
//        var_dump($request->getUser());
//        var_dump($request->getSession()->all());
//        var_dump($request->getUser());
//        var_dump($this->security);
//        var_dump($this->security->getToken());
//        var_dump($this->security->getUser());

//        var_dump($request->getSession()->get('_security_main'));
//        var_dump($request->headers);
//         die;
        if ($this->security->getUser()) {
            return false;
        }

        return true;
//        return $request->headers->has('X-AUTH-TOKEN');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCredentials(Request $request): array
    {

//        var_dump($request);
        return [
            'token' => $request->headers->get('X-AUTH-TOKEN'),
        ];
    }

    /**
     * Return a UserInterface object based on the credentials.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * You may throw an AuthenticationException if you wish. If you return
     * null, then a UsernameNotFoundException is thrown for you.
     *
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return UserInterface|null
     * @throws AuthenticationException
     *
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $apiToken = $credentials['token'];

        if (null === $apiToken) {
            return;
        }



        // if a User object, checkCredentials() is called
//        return $this->em->getRepository(User::class)
//            ->findOneBy(['apiToken' => $apiToken]);
    }

    /**
     * Returns true if the credentials are valid.
     *
     * If any value other than true is returned, authentication will
     * fail. You may also throw an AuthenticationException if you wish
     * to cause authentication to fail.
     *
     * The *credentials* are the return value from getCredentials()
     *
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return true;
    }

    /**
     * Called when authentication executed, but failed (e.g. wrong username password).
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return JsonResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): JsonResponse
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey The provider (i.e. firewall) key
     *
     * @return null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    /**
     * @return bool
     */
    public function supportsRememberMe(): bool
    {
        return false;
    }
}