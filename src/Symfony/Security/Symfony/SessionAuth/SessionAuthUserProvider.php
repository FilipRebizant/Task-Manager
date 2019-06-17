<?php

declare(strict_types=1);

namespace App\Symfony\Security\Symfony\SessionAuth;

use App\Application\Query\User\UserQueryInterface;
use App\Infrastructure\Exception\NotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class SessionAuthUserProvider implements UserProviderInterface
{
    /** @var UserQueryInterface  */
    private $userQuery;

    /**
     * SessionAuthUserProvider constructor.
     *
     * @param UserQueryInterface $userQuery
     */
    public function __construct(UserQueryInterface $userQuery)
    {
        $this->userQuery = $userQuery;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username): UserInterface
    {
        try {
            $user = $this->userQuery->getSessionAuthUserByUsername($username);
        } catch (NotFoundException $exception) {
            throw new UsernameNotFoundException;
        }

        return $user;
    }

    /**
     * @return UserInterface
     *
     * @throws UnsupportedUserException  if the user is not supported
     * @throws UsernameNotFoundException if the user is not found
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class): bool
    {
        return SessionAuthUser::class === $class;
    }
}
