<?php

namespace App\Domain;


class Priority
{
    /** @var int */
    private $priority;

    /**
     * Priority constructor.
     * @param int $priority
     * @throws \Exception
     */
    public function __construct(int $priority)
    {
        if ($priority < 0) {
            throw new \Exception("Priority must be greater then 0");
        }

        $this->priority = $priority;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }
}
