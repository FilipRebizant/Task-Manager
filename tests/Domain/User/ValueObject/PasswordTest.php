<?php

namespace App\Tests\Domain\User\ValueObject;

use App\Domain\User\Exception\InvalidPasswordException;
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
     * @throws InvalidPasswordException
     */
    public function testExpectThrowInvalidPasswordExceptionWhenProvidingTooShortPassword()
    {
        $this->expectException(InvalidPasswordException::class);

        new Password("short");
    }
}
