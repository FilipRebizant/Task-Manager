<?php

declare(strict_types=1);

namespace App\Domain\Task;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\Exception\InvalidStatusOrderException;
use App\Domain\Task\Exception\UserAlreadyAssignedException;
use App\Domain\Task\Exception\UserNotAssignedException;
use App\Domain\Task\ValueObject\Title;
use App\Domain\Task\ValueObject\Description;
use App\Domain\Task\ValueObject\Priority;
use App\Domain\Task\ValueObject\Status;
use App\Domain\User\User;
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

    /** @var Title */
    private $title;

    /** @var Description */
    private $description;

    /** @var \DateTimeImmutable */
    private $createdAt;

    /** @var \DateTimeImmutable */
    private $updatedAt;

    /**
     * Task constructor.
     * @param Uuid $uuid
     * @param Title $title
     * @param Status $status
     * @param User|null $user
     * @param Priority $priority
     * @param Description $description
     * @throws \Exception
     */
    public function __construct(
        Uuid $uuid,
        Title $title,
        Status $status,
        ?User $user,
        Priority $priority,
        Description $description
    ) {
        $this->id = $uuid;
        $this->title = $title;
        $this->status = $status;
        $this->user = $user;
        $this->priority = $priority;
        $this->description = $description;
        $this->createdAt = new \DateTimeImmutable('now');
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
    public function getAssignedUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Task
     */
    public function assignUser(User $user): Task
    {
        if (is_null($this->getAssignedUser())) {
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
     * @return Title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * @param Title $title
     * @return Task
     */
    public function updateTitle(Title $title): Task
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * @return Task
     * @throws InvalidStatusOrderException
     * @throws UserNotAssignedException
     */
    public function changeStatus(Status $status): Task
    {
        if (is_null($this->getAssignedUser())) {
            throw new UserNotAssignedException("Can't change status of task without assigned user");
        }

        if ($this->getStatus() == "Todo" && $status == "Pending") {
            $this->status = $status;

            return $this;
        } elseif ($this->status == "Pending" && $status == "Done") {
            $this->status = $status;

            return $this;
        } elseif ($this->status == "Done" && $status == "Todo") {
            $this->status = $status;

            return $this;
        } else {
            throw new InvalidStatusOrderException("Invalid status order.");
        }
    }

    /**
     * @return Priority
     */
    public function getPriority(): Priority
    {
        return $this->priority;
    }

    /**
     * @param Priority $priority
     * @return Task
     */
    public function updatePriority(Priority $priority): Task
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /**
     * @param Description $description
     * @return Task
     */
    public function updateDescription(Description $description): Task
    {
        $this->description = $description;

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
