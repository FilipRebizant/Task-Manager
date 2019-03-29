<?php declare(strict_types=1);

namespace App\Domain;

use Ramsey\Uuid\Uuid;

class Task
{
    /** @var Uuid */
    private $id;

    /** @var User */
    private $user;

     /** @var Status */
    private $status;

    /** @var Priority */
    private $priority;

    /** @var string */
    private $description;

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var \DateTimeImmutable */
    private $updatedAt;

    /**
     * Task constructor.
     * @param Uuid $id
     * @param Status $status
     * @param User $user
     * @param Priority $priority
     * @param string $description
     * @param \DateTimeImmutable|null $createdAt
     * @param \DateTimeImmutable|null $updatedAt
     * @throws \Exception
     */
    public function __construct(
        Uuid $id,
        Status $status,
        User $user,
        Priority $priority,
        string $description,
        \DateTimeImmutable $createdAt = null,
        \DateTimeImmutable $updatedAt = null
    )
    {
        $this->id = $id;
        $this->status = $status;
        $this->user = $user;
        $this->priority = $priority;
        $this->description = $description;
        $this->createdAt = new \DateTimeImmutable('now');
        $this->updatedAt = is_null($updatedAt) ? new \DateTimeImmutable('now'): $updatedAt;
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return null|User
     */
    public function getAssignedUser(): ? User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Task
     */
    public function assignUser(User $user): Task
    {
        if (is_null($this->getAssignedUser())){
            $this->user = $user;
        }

        return $this;
    }

    /**
     * @param User $user
     * @return Task
     */
    public function unassignUser(User $user): Task
    {
        if ($this->user === $user) {
            $this->user = null;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status->getStatus();
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority->getPriority();
    }

    /**
     * @param int $priority
     * @return Task
     * @throws \Exception
     */
    public function setPriority(int $priority): Task
    {
        $this->priority = new Priority($priority);

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Task
     */
    public function setDescription(string $description): Task
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Task
     * @throws \Exception
     */
    public function setDone(): Task
    {
        $this->status = new Status('Done');

        return $this;
    }

    /**
     * @return Task
     * @throws \Exception
     */
    public function setPending(): Task
    {
        $this->status = new Status('Pending');

        return $this;
    }

    /**
     * @return Task
     * @throws \Exception
     */
    public function setToDo(): Task
    {
        $this->status = new Status('Todo');

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     * @return Task
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): Task
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     * @return Task
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): Task
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
