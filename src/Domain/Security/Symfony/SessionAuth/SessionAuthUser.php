<?php

declare(strict_types=1);

namespace App\Domain\Security\Symfony\SessionAuth;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SessionAuthUser implements UserInterface, EquatableInterface
{
    /** @var string  */
    private $role;

    /** @var string  */
    private $username;

    /** @var string|null  */
    private $password;

    /** @var string */
    private $id;

    public function __construct(string $id, string $username, ?string $password, string $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles[] = 'ROLE_USER';
        $roles[] = 'ROLE_' . $this->role;

        return array_unique($roles);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getPassword(): ?string
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
