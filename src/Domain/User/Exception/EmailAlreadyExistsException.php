<?php

namespace App\Domain\User\Exception;

use Throwable;

class EmailAlreadyExistsException extends \Exception
{
    public function __construct($message = "Email address is already taken.", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
