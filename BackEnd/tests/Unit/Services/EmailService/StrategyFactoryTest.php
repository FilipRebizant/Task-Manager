<?php

namespace App\Tests\Unit\Services\EmailService;

use App\Services\EmailService\Exception\ProviderException;
use App\Services\EmailService\Provider\SendGrid\SendGrid;
use App\Services\EmailService\StrategyFactory;
use PHPUnit\Framework\TestCase;
use Zalas\Injector\PHPUnit\Symfony\TestCase\SymfonyTestContainer;
use Zalas\Injector\PHPUnit\TestCase\ServiceContainerTestCase;

class StrategyFactoryTest extends TestCase implements ServiceContainerTestCase
{
    use SymfonyTestContainer;

    /**
     * @var SendGrid
     * @inject
     */
    private $sendgrid;

    public function testWillGetDefaultStrategy()
    {
        $factory = new StrategyFactory($this->sendgrid);

        $this->assertInstanceOf(SendGrid::class, $factory->getStrategy());
    }

    public function testWillGetChosenStrategy()
    {
        $factory = new StrategyFactory($this->sendgrid);

        $this->assertInstanceOf(SendGrid::class, $factory->getStrategy('sendgrid'));
    }

    public function testWillThrowExceptionWhenProvidingNonExistingProvider()
    {
        $this->expectException(ProviderException::class);

        $factory = new StrategyFactory($this->sendgrid);

        $factory->getStrategy('Not existing provider');
    }
}
