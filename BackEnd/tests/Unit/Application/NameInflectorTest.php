<?php

namespace App\Tests\Unit\Application;

use App\Application\Command\CreateTaskCommand;
use App\Application\Handler\CreateTaskHandler;
use App\Application\NameInflector;
use PHPUnit\Framework\TestCase;

class NameInflectorTest extends TestCase
{
    public function testShouldGetHandlerNameFromCommand()
    {
        $command = new CreateTaskCommand('Todo', null, 1,'Desc');
        $inflector = new NameInflector();
        $handler = $inflector->inflect($command);

        $this->assertEquals(CreateTaskHandler::class, $handler);
    }
}
