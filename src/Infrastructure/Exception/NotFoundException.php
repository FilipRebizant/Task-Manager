<?php

namespace App\Infrastructure\Exception;

use Throwable;

class NotFoundException extends \Exception
{
 public function __construct($message = "", $code = 404, Throwable $previous = null)
 {
     parent::__construct($message, $code, $previous);
 }
}
