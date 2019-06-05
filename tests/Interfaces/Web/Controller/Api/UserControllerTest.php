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
        $data = [
            'username' => 'Filip',
        ];

//        var_dump($token = $this->getService('lexik_jwt_authentication.encoder')
//            ->encode(['username' => 'weaverryan']));


        $response = $this->client->post('/api/users', [
            'body' => json_encode($data),
            'headers' => [
                'Authorization' => 'Bearer abc',
            ]
        ]);

        $this->assertEquals(403, $response->getStatusCode());

        $finishedData = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('username', $finishedData);

    }
}
