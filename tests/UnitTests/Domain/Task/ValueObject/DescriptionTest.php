<?php

namespace App\Tests\Domain\Task\ValueObject;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\ValueObject\Description;
use PHPUnit\Framework\TestCase;

class DescriptionTest extends TestCase
{
    public function testCanCreateDescription()
    {
        $description = new Description("Description of the task");

        $expectedPriority = "Description of the task";

        $this->assertEquals($expectedPriority, $description);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testWillThrowExceptionOnEmptyDescription()
    {
        $this->expectException(InvalidArgumentException::class);

        new Description('');
    }
}
