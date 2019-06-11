<?php

namespace App\Tests\Interfaces\Web\Controller\Api;

use App\Application\Query\User\UserQueryInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Username;
use GuzzleHttp\Client;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserControllerTest extends WebTestCase
{
    /** @var Client */
    private $client;

    /** @var User */
    private $user;

    /** @var UserQueryInterface */
    private $userQuery;

    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var string */
    private $token;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = self::$kernel->getContainer();
        $this->userQuery = $container->get('userQuery');
        $this->userRepository = $container->get('userRepository');

        $uuid = Uuid::uuid4();
        $this->user = new User(
            $uuid,
            new Username('username1'),
            new Password('password'),
            new Email('username1@gmail.com'),
            []
        );

        $this->userRepository->create($this->user);

        $securityUser = $this->userQuery->getSessionAuthUserByUsername('username1');
        $jwtManager = $container->get('lexik_jwt_authentication.jwt_manager');

        $this->token = $jwtManager->create($securityUser);

        $this->client = new Client([
            'allow_redirects' => true,
            'http_errors' => false,
        ]);
    }

    protected function tearDown(): void
    {
        $this->userRepository->delete($this->user->getId()->toString());
    }

    public function testCanCreateUserSuccessfully()
    {
        $data = [
            'username' => 'testUsername',
            'email' => 'testUsername@gmail.com',
            'password1' => 'password',
            'password2' => 'password',
        ];

        $response = $this->client->post('nginx/api/users', [
            'body' => json_encode($data),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $returnedUser = $this->userQuery->getByUsername('testUsername');

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('testUsername', $returnedUser->username());

        $this->userRepository->delete($returnedUser->id());
    }

    public function testCanNotCreateUserOnWrongUsername()
    {
        $data = [
            'username' => '2testUsername',
            'email' => 'testUsername@gmail.com',
            'password1' => 'password',
            'password2' => 'password',
        ];

        $expectedResult = json_encode([
            'error' => [
                'status' => 400,
                'message' => 'Provided username is invalid',
            ],
        ]);

        $response = $this->client->post('nginx/api/users', [
            'body' => json_encode($data),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString($expectedResult, $response->getBody());
    }

    public function testCanNotCreateUserOnWrongEmail()
    {
        $data = [
            'username' => 'testUsername',
            'email' => '2testUsername@gmail.com',
            'password1' => 'password',
            'password2' => 'password',
        ];

        $expectedResult = json_encode([
            'error' => [
                'status' => 400,
                'message' => 'Provided email address is invalid',
            ],
        ]);

        $response = $this->client->post('nginx/api/users', [
            'body' => json_encode($data),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString($expectedResult, $response->getBody());
    }

    public function testCanNotCreateUserOnWrongPassword()
    {
        $data = [
            'username' => 'testUsername',
            'email' => 'testUsername@gmail.com',
            'password1' => 'passw',
            'password2' => 'passw',
        ];

        $expectedResult = json_encode([
            'error' => [
                'status' => 400,
                'message' => 'Provided password is invalid',
            ],
        ]);

        $response = $this->client->post('nginx/api/users', [
            'body' => json_encode($data),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString($expectedResult, $response->getBody());
    }

    public function testCanNotCreateUserWhenPasswordsDoesntMatch()
    {
        $data = [
            'username' => 'testUsername',
            'email' => 'testUsername@gmail.com',
            'password1' => 'password',
            'password2' => 'passwword',
        ];

        $expectedResult = json_encode([
            'error' => [
                'status' => 400,
                'message' => 'Provided passwords doesn\'t match',
            ],
        ]);

        $response = $this->client->post('nginx/api/users', [
            'body' => json_encode($data),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString($expectedResult, $response->getBody());
    }

    public function testCanGetUser()
    {
        $response = $this->client->get('nginx/api/users/' . $this->user->getId()->toString(), [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $resultArray = json_decode($response->getBody(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('username1', $resultArray['username']);
    }

    public function testGetUsers()
    {
        $response = $this->client->get('nginx/api/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $finishedData = json_decode($response->getBody(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('users', $finishedData);
    }

    public function testDeleteUser()
    {
        $expectedResult = json_encode(['result' => 'User has been deleted']);
        $uuid = Uuid::uuid4();
        $user = new User(
            $uuid,
            new Username('testDeleteUsername'),
            new Password('password'),
            new Email('testDeleteUsername@gmail.com'),
            []
        );
        $this->userRepository->create($user);
        $returnedUser = $this->userQuery->getByUsername('testDeleteUsername');

        $response = $this->client->delete('nginx/api/users/' . $returnedUser->id(), [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString($expectedResult, $response->getBody());
    }

    public function testDeleteUserErrorOnNonExistingUser()
    {
        $expectedResult = json_encode([
            'error' => [
                'status' => 404,
                'message' => 'User was not found',
            ],
        ]);

        $response = $this->client->delete('nginx/api/users/' . Uuid::uuid4()->toString(), [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString($expectedResult, $response->getBody());
    }
}
