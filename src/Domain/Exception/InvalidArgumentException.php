<?php

namespace App\Domain\Exception;

use Throwable;

class InvalidArgumentException extends \Exception
{
    public function __construct($message = "Invalid argument passed", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
