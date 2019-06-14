<?php

namespace App\Tests\Unit\Domain\Task\ValueObject;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\ValueObject\Priority;
use PHPUnit\Framework\TestCase;

class PriorityTest extends TestCase
{
    /**
     * @throws InvalidArgumentException
     */
    public function testCanCreatePriority()
    {
        $priority = new Priority(1);

        $expectedPriority = 1;

        $this->assertEquals($expectedPriority, $priority->getPriority());
    }

    /**
     * @throws \App\Domain\Exception\InvalidArgumentException
     */
    public function testWillThrowExceptionOnNegativeValue()
    {
        $this->expectException(InvalidArgumentException::class);

        new Priority(-2);
    }
}
