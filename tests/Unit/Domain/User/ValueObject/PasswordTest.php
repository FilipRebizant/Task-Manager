<?php

namespace App\Tests\Unit\Domain\User\ValueObject;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\User\ValueObject\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testCanCreateCorrectPassword()
    {
        $password = new Password("Password");

        $this->assertEquals("Password", $password);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testExpectThrowInvalidPasswordExceptionWhenProvidingTooShortPassword()
    {
        $this->expectException(InvalidArgumentException::class);

        new Password("short");
    }
}
