<?php

namespace App\Tests\Unit\Domain\User\ValueObject;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\User\ValueObject\Role;
use PHPStan\Testing\TestCase;

class RoleTest extends TestCase
{
    public function testCanCreateCorrectRole()
    {
        $role = new Role("ADMIN");

        $this->assertEquals("ADMIN", $role);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testExpectThrowInvalidPasswordExceptionWhenProvidingTooShortPassword()
    {
        $this->expectException(InvalidArgumentException::class);

        new Role("non existing Role");
    }
}
