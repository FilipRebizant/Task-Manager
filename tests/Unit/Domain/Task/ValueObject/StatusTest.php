<?php

namespace App\Tests\Unit\Domain\Task\ValueObject;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\ValueObject\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testValidStatus()
    {
        $status = new Status('Todo');

        $this->assertEquals('Todo', $status);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testInvalidStatus()
    {
        $this->expectException(InvalidArgumentException::class);

        new Status('Invalid Status');
    }
}
