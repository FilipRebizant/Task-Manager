<?php

declare(strict_types=1);

namespace App\Domain\Security\Auth0\User;

use Auth0\JWTAuthBundle\Security\Core\JWTUserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class WebServiceUserProvider implements JWTUserProviderInterface
{
    /**
     * @param string $jwt
     * @return WebServiceUser
     */
    public function loadUserByJWT($jwt)
    {
        $data = ['sub' => $jwt->sub];
        $roles = array();
        $roles[] = 'ROLE_OAUTH_AUTHENTICATED';

        return new WebServiceUser($data, $roles);
    }

    /**
     * @return WebServiceAnonymousUser
     */
    public function getAnonymousUser()
    {
        return new WebServiceAnonymousUser();
    }

    public function loadUserByUsername($username)
    {
    }


    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebServiceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class): bool
    {
        return $class === WebServiceUser::class;
    }
}
