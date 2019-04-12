<?php
declare(strict_types=1);

namespace App\Domain\Task\ValueObject;

use InvalidArgumentException;

class Priority
{
    /** @var int */
    private $priority;

    /**
     * Priority constructor.
     * @param int $priority
     * @throws InvalidArgumentException
     */
    public function __construct(int $priority)
    {
        if ($priority < 0) {
            throw new InvalidArgumentException("Priority must be greater then 0");
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
