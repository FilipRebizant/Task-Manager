<?php

namespace App\Tests\Unit\Domain\ActivationToken;

use App\Domain\ActivationToken\ActivationToken;
use App\Domain\User\User;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ActivationTokenTest extends TestCase
{
    private $userMock;

    protected function setUp(): void
    {
        $this->userMock = $this->getMockBuilder(User::class)->disableOriginalConstructor()->getMock();
    }

    public function testWillGenerateCorrectProperties()
    {
        $activationToken = new ActivationToken(null, $this->userMock);

        $this->assertInstanceOf(Uuid::class, $activationToken->getId());
        $this->assertEquals(36, strlen($activationToken->getToken()));
        $this->assertEquals(null, $activationToken->getActivatedAt());
        $this->assertInstanceOf(User::class, $activationToken->getUser());
    }

    public function testIfCanAssignUserId()
    {
        $uuid = Uuid::uuid4();

        $activationToken = new ActivationToken($uuid, $this->userMock);

        $this->assertEquals($uuid, $activationToken->getId());
    }

    public function testCanAssignActivatedAt()
    {
        $activationToken = new ActivationToken(null, $this->userMock);
        $date = new \DateTimeImmutable();

        $activationToken->setActivatedAt($date);

        $this->assertEquals($date, $activationToken->getActivatedAt());
    }
}
