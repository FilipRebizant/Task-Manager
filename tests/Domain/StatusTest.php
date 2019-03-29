<?php

namespace App\Tests\Domain;


use App\Domain\Status;
use PHPUnit\Framework\TestCase;

class StatusTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testValidStatus()
    {
        $status = new Status('Todo');

        $this->assertEquals('Todo', $status->getStatus());
    }

    /**
     * @throws \Exception
     */
    public function testInvalidStatus()
    {

        $this->expectException(\Exception::class);

        new Status('Invalid Status');
    }
}
