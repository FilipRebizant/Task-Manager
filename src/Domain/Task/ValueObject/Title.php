<?php

declare(strict_types=1);

namespace App\Domain\Task\ValueObject;

use App\Domain\Exception\InvalidArgumentException;

class Title
{
    /** @var string  */
    private $title;

    /**
     * Title constructor.
     * @param string $title
     * @throws InvalidArgumentException
     */
    public function __construct(string $title)
    {
        if (empty($title)) {
            throw new InvalidArgumentException("Title of the task can not be empty.");
        }

        $this->title = $title;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->title;
    }
}
