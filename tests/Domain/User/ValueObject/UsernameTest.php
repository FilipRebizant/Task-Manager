<?php

namespace App\Tests\Domain\User\ValueObject;

use App\Domain\User\Exception\InvalidUsernameException;
use App\Domain\User\ValueObject\Username;
use PHPUnit\Framework\TestCase;

class UsernameTest extends TestCase
{
    /**
     * @throws InvalidUsernameException
     */
    public function testCanCreateCorrectUsername()
    {
        $username = new Username("Username");

        $this->assertEquals("Username", $username);
    }

    /**
     * @throws InvalidUsernameException
     */
    public function testExpectThrowInvalidUsernameExceptionWhenProvidingLeadingNumber()
    {
        $this->expectException(InvalidUsernameException::class);

        new Username("9Username");
    }
}
