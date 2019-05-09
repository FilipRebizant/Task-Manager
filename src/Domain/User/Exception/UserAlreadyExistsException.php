<?php

namespace App\Domain\User\Exception;

use Throwable;

class UserAlreadyExistsException extends \Exception
{
    public function __construct($message = "User already exists.", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
