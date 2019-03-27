<?php declare(strict_types=1);

namespace App\Domain;

abstract class Status
{
    const __default = self::Todo;

    const Todo = 1;
    const Pending = 2;
    const Done = 3;
}
