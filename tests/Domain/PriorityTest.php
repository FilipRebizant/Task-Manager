<?php

namespace App\Tests\Domain;


use App\Domain\Priority;
use PHPUnit\Framework\TestCase;

class PriorityTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCanCreatePriority()
    {
        $priority = new Priority(1);

        $expectedPriority = 1;

        $this->assertEquals($expectedPriority, $priority->getPriority());
    }

    /**
     * @throws \Exception
     */
    public function testWillThrowExceptionOnNegativeValue()
    {
        $this->expectException(\Exception::class);

        new Priority(-2);
    }
}
