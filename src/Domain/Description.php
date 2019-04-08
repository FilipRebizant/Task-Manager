<?php declare(strict_types=1);

namespace App\Domain;

use InvalidArgumentException;

final class Description
{
    /** @var string */
    private $description;

    /**
     * Description constructor.
     * @param string $description
     * @throws InvalidArgumentException
     */
    public function __construct(string $description)
    {
        if (empty($description)) {
            throw new InvalidArgumentException("Description can not be empty.");
        }

        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->description;
    }
}
