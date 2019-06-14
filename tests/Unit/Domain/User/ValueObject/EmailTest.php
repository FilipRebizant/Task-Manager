<?php

namespace App\Tests\Unit\Domain\User\ValueObject;

use App\Domain\Exception\InvalidArgumentException;
use App\Domain\User\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function wrongEmailsProvider() {
        return [
            'providing empty string' => [''],
            'invalid email address' => ['invalid_email_address'],
            'providing space at the begin' => [' wrong@gmail.com'],
            'providing number at the begin' => ['9wrong@gmail.com'],
            'providing space after after domain' => ['wrong@gmail .com'],
            'providing numbers at the end' => ['wrongemail@gmail.com3323'],
            'providing numbers at the end of two part domain' => ['wrongemail@gmail.co.uk2323'],
            'providing special characters before domain' => ['wrong$%^@gmail.com'],
            'providing special characters after domain' => ['wrong@$%^gmail.com'],
            'providing special characters at the end' => ['wrong@gmail.com$%^'],
        ];
    }

    public function validEmailsProvider() {
        return [
            'email with numbers' => ['validemail_2000@gmail.com'],
            'with dot' => ['valid.email_2000@gmail.com'],
            'two part domain' => ['validEmail@gmail.co.uk'],
            'domain with dash' => ['validEmail@two-part.com'],
            'two part domain with dash' => ['validEmail@two-part.co.uk'],
        ];
    }

    /**
     * @oaram string $email
     * @dataProvider wrongEmailsProvider
     * @throws InvalidArgumentException
     */
    public function testEmailExceptions($email)
    {
        $this->expectException(InvalidArgumentException::class);

        new Email($email);
    }

    /**
     * @param string $email
     * @dataProvider validEmailsProvider
     * @throws InvalidArgumentException
     */
    public function testValidEmails($email) {
        $this->assertEquals($email, new Email($email));
    }
}
