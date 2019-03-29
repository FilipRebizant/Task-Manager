<?php

namespace App\Infrastructure;

use App\Domain\Repository\UserRepository;
use App\Domain\User;
use Doctrine\ORM\EntityManager;

class DoctrineUserRepository implements UserRepository
{
    /** @var EntityManager */
    protected $em;

    /**
     * DoctrineUserRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(User $user)
    {
        $this->em->persist($user);
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(User $user)
    {
        $this->em->remove($user);
    }
}
