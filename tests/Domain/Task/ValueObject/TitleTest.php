<?php

namespace App\Tests\Domain\Task\ValueObject;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\Task\ValueObject\Title;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    public function testValidStatus()
    {
        $title = new Title("New title of the task");

        $this->assertEquals('New title of the task', $title);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testInvalidStatus()
    {
        $this->expectException(InvalidArgumentException::class);

        new Title('');
    }
}
