<?php

namespace Model;

class Status
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $cratedAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Status
     */
    public function setStatus(string $status): Status
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCratedAt(): \DateTime
    {
        return $this->cratedAt;
    }

    /**
     * @param \DateTime $cratedAt
     * @return Status
     */
    public function setCratedAt(\DateTime $cratedAt): Status
    {
        $this->cratedAt = $cratedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Status
     */
    public function setUpdatedAt(\DateTime $updatedAt): Status
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
