<?php
declare(strict_types=1);

namespace App\Domain\Task\ValueObject;

use InvalidArgumentException;

class Status
{
    /**
     * @var array
     */
    private $validStatuses = [
        'Todo',
        'Pending',
        'Done'
    ];

    /** @var string */
    private $status;

    /**
     * Status constructor.
     * @param string $status
     * @throws InvalidArgumentException
     */
    public function __construct(string $status)
    {
        if (!in_array($status, $this->validStatuses)) {
            throw new InvalidArgumentException("This is not a valid status.");
        }

        $this->status = $status;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->status;
    }
}
