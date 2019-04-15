<?php

namespace App\Tests\Application;

use App\Application\Command\CreateNewTaskCommand;
use App\Application\Handler\CreateNewTaskHandler;
use App\Application\NameInflector;
use PHPUnit\Framework\TestCase;

class NameInflectorTest extends TestCase
{
    /** @var NameInflector */
    private $inflector;

    public function setUp(): void
    {
        $this->inflector = new NameInflector();
    }

    public function testShouldGetHandlerNameFromCommand()
    {
        $command = new CreateNewTaskCommand('Todo', null,"Todo" , 1,'Desc');

        $handler = $this->inflector->inflect($command);

        $this->assertEquals(CreateNewTaskHandler::class, $handler);

    }
}
