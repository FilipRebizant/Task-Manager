<?php

declare(strict_types=1);

namespace App\Domain\Security\Symfony\User;

use App\Domain\User\ValueObject\Password;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityUser implements UserInterface, EquatableInterface
{
    /** @var array  */
    private $roles = [];

    /** @var string  */
    private $username;

    /** @var Password  */
    private $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @param UserInterface $user
     * @return bool
     */
    public function isEqualTo(UserInterface $user): bool
    {
        if ($user->getUsername() === $this->getUsername()) {
            return true;
        }

        return false;
    }

    public function __toString()
    {
        return $this->username;
    }
}
