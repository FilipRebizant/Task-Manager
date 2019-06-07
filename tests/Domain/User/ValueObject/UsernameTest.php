<?php

namespace App\Tests\Domain\User\ValueObject;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\User\ValueObject\Username;
use PHPUnit\Framework\TestCase;

class UsernameTest extends TestCase
{
    /**
     * @throws InvalidArgumentException
     */
    public function testCanCreateCorrectUsername()
    {
        $username = new Username("Username");

        $this->assertEquals("Username", $username);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testExpectThrowInvalidUsernameExceptionWhenProvidingLeadingNumber()
    {
        $this->expectException(InvalidArgumentException::class);

        new Username("9Username");
    }
}
