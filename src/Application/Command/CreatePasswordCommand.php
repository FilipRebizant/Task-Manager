<?php

namespace App\Application\Command;

use App\Application\CommandInterface;

class CreatePasswordCommand implements CommandInterface
{
    /** @var string */
    private $password1;

    /** @var string */
    private $password2;

    /**
     * CreatePasswordCommand constructor.
     *
     * @param string $password1
     * @param string $password2
     */
    public function __construct(string $password1, string $password2)
    {
        $this->password1 = $password1;
        $this->password2 = $password2;
    }

    /**
     * @return string
     */
    public function password1(): string
    {
        return $this->password1;
    }

    /**
     * @return string
     */
    public function password2(): string
    {
        return $this->password2;
    }
}
