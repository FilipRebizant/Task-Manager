<?php

namespace Domain;

class Status extends \SplEnum
{
    const __default = self::Todo;

    const Todo = 1;
    const Pending = 2;
    const Done = 3;

    /** @var \DateTime */
    private $cratedAt;

    /** @var \DateTime */
    private $updatedAt;

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
