<?php

namespace App\Domain\ActivationToken;

use App\Domain\User\User;
use Ramsey\Uuid\Uuid;

class ActivationToken
{
    /** @var Uuid */
    private $id;

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var \DateTimeImmutable|null */
    private $activatedAt;

    /** @var string */
    private $token;

    /** @var User */
    private $user;

    /**
     * ActivationToken constructor.
     *
     * @param Uuid|null $id
     * @param User $user
     */
    public function __construct(?Uuid $id, User $user)
    {
        $this->id = is_null($id) ? Uuid::uuid4(): $id;
        $this->createdAt = new \DateTimeImmutable('now');
        $this->activatedAt = null;
        $this->token = Uuid::uuid4()->toString();
        $this->user = $user;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getActivatedAt(): ?\DateTimeImmutable
    {
        return $this->activatedAt;
    }

    /**
     * @param \DateTimeImmutable|null $activatedAt
     * @return ActivationToken
     */
    public function setActivatedAt(?\DateTimeImmutable $activatedAt): ActivationToken
    {
        $this->activatedAt = $activatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
