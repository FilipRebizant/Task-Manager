<?php

namespace App\Infrastructure;


use App\Domain\Repository\TaskRepository;
use App\Domain\Task;
use Doctrine\ORM\EntityManager;

class DoctrineTaskRepository implements TaskRepository
{
    /** @var EntityManager */
    protected $em;

    /**
     * DoctrineTaskRepository constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param Task $task
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(Task $task)
    {
        $this->em->persist($task);
    }

    /**
     * @param Task $task
     * @throws \Doctrine\ORM\ORMException
     */
    public function remove(Task $task)
    {
        $this->em->remove($task);
    }
}
