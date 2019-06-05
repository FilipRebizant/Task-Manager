<?php

declare(strict_types=1);

namespace App\Domain\Security\Symfony\SessionAuth;

use App\Application\Query\User\UserQueryInterface;
use App\Infrastructure\Exception\NotFoundException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    private $userQuery;
    private $router;
    private $csrfTokenManager;
    private $passwordEncoder;

    private $successHandler;
    private $jwtManager;

    private $user;

    public function __construct(
        UserQueryInterface $userQuery,
        RouterInterface $router,
        CsrfTokenManagerInterface $csrfTokenManager,
        UserPasswordEncoderInterface $passwordEncoder,
        JWTTokenManagerInterface $jwtManager,
   AuthenticationSuccessHandler $successHandler

    ) {
        $this->userQuery = $userQuery;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->jwtManager = $jwtManager;
        $this->successHandler = $successHandler;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request)
    {
        return 'login' === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email'],
        );

        return $credentials;
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return SessionAuthUser|UserInterface|null
     * @throws \App\Infrastructure\Exception\NotFoundException
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }
        try {
            $user = $this->userQuery->getSessionAuthUserByEmail($credentials['email']);
        } catch (NotFoundException $exception) {
            throw new CustomUserMessageAuthenticationException('Email could not be found.');
        }
        $this->user = $user;
        return $user;
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
//        var_dump($providerKey);
//        $jwtToken = $request->getSession()->set('jwt_token', $this->jwtManager->create($this->user));
//        var_dump($request->getSession()->get('jwt_token'));
//        var_dump($jwtToken);
//        die;
//        $authenticationSuccessHandler = $this->container->get('lexik_jwt_authentication.handler.authentication_success');
        $this->successHandler->handleAuthenticationSuccess($this->user);

        $token = $this->jwtManager->create($this->user);
//        var_dump($token);
//        die;
        $request->getSession()->set('jwt_token', $token);
//        var_dump($this->successHandler);

//        var_dump($authenticationSuccessHandler);
//        die;

        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->router->generate('home'));
    }

    /**
     * @return string
     */
    protected function getLoginUrl()
    {
        return $this->router->generate('login');
    }
}
