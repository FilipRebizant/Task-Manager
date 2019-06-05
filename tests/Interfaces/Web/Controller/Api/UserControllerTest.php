<?php

namespace App\Tests\Interfaces\Web\Controller\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    /** @var Client */
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_url' => 'http://localhost',
            'defaults' => [
              'exceptions' => false,
            ],
        ]);
    }

    public function testGetUsers() {
        $response = $this->client->post('/api/users');

        $this->assertEquals(200, $response->getStatusCode());

        $finishedData = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('username', $finishedData);

    }
}
