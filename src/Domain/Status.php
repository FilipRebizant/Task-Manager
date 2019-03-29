<?php declare(strict_types=1);

namespace App\Domain;

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
     * @throws \Exception
     */
    public function __construct(string $status)
    {
        if (!in_array($status, $this->validStatuses)) {
            throw new \Exception("This is not a valid status.");
        }

        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->status;
    }
}
