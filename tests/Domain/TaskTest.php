<?php

namespace App\Tests\Domain;

use App\Domain\Status;
use App\Domain\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testAssignTaskIsToDo()
    {
        $task = new Task();
        $task->setToDo();

        $this->assertEquals(1, $task->getStatus());
    }

    public function testAssignTaskIsPending()
    {
        $task = new Task();
        $task->setPending();
        $status = $task->getStatus();

        $statusMock = Status::Pending;

        $this->assertEquals($statusMock, $status);
    }
}
