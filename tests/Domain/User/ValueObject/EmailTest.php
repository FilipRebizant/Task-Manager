<?php

namespace App\Tests\Domain\User\ValueObject;

use App\Domain\User\Exception\InvalidEmailException;
use App\Domain\User\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testCanCreateValidEmailAddress()
    {
        $email = new Email('validemail_2000@gmail.com');

        $this->assertEquals('validemail_2000@gmail.com', $email);
    }

    public function testCanCreateEmailAddressWhenHaveDot()
    {
        $email = new Email('valid.email_2000@gmail.com');

        $this->assertEquals('valid.email_2000@gmail.com', $email);
    }

    public function testCanCreateValidEmailAddressWithTwoPartDomain()
    {
        $email = new Email('validEmail@gmail.co.uk');

        $this->assertEquals('validEmail@gmail.co.uk', $email);
    }

    public function testWillThrowExceptionWhenProvidingEmptyString()
    {
        $this->expectException(InvalidEmailException::class);

        new Email('');
    }

    public function testWillThrowExceptionWhenProvidingWrongEmail()
    {
        $this->expectException(InvalidEmailException::class);

        new Email('invalid_email_address');
    }

    public function testWillThrowExceptionWhenProvidingSpaceAtTheBegin()
    {
        $this->expectException(InvalidEmailException::class);

        new Email(' wrong@gmail.com');
    }

    public function testWillThrowExceptionWhenProvidingNumberAtTheBegin()
    {
        $this->expectException(InvalidEmailException::class);

        new Email('9wrong@gmail.com');
    }

    public function testWillThrowExceptionWhenProvidingSpaceAfterDomain()
    {
        $this->expectException(InvalidEmailException::class);

        new Email('wrong@gmail .com');
    }

    public function testWillThrowExceptionWhenProvidingNumbersAtTheEnd()
    {
        $this->expectException(InvalidEmailException::class);

        new Email('wrongemail@gmail.com3323');
    }

    public function testWillThrowExceptionWhenProvidingNumbersAtTheEndOfTwoPartDomain()
    {
        $this->expectException(InvalidEmailException::class);

        new Email('wrongemail@gmail.co.uk2323');
    }
}
