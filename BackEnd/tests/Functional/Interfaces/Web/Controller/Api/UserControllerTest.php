<?php

namespace App\Tests\Functional\Interfaces\Web\Controller\Api;

use App\Application\Query\User\UserQueryInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use GuzzleHttp\Client;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zalas\Injector\PHPUnit\Symfony\TestCase\SymfonyTestContainer;
use Zalas\Injector\PHPUnit\TestCase\ServiceContainerTestCase;

class UserControllerTest extends WebTestCase implements ServiceContainerTestCase
{
    use SymfonyTestContainer;

    /** @var Client */
    private $client;

    /** @var User */
    private $user;

    /** @var string */
    private $token;

    /** @var UserQueryInterface
     * @inject
     */
    private $userQuery;

    /**
     * @var UserRepositoryInterface
     * @inject
     */
    private $userRepository;

    /**
     * @var JWTTokenManagerInterface
     * @inject
     */
    private $jwtManager;

    protected function setUp(): void
    {
        $this->user = new User(
            Uuid::uuid4(),
            new Username('username1'),
            new Email('username1@gmail.com'),
            new Role('ADMIN'),
            []
        );

        $this->userRepository->create($this->user);

        $securityUser = $this->userQuery->getSessionAuthUserByUsername('username1');

        $this->token = $this->jwtManager->create($securityUser);

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
            'role' => 'ADMIN',
            'email' => 'testUsername@gmail.com',
        ];

        $response = $this->client->post('nginx/api/users', [
            'body' => json_encode($data),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $returnedUser = $this->userQuery->getByUsername('testUsername');

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('testUsername', $returnedUser->getUsername());

        $this->userRepository->delete($returnedUser->getId());
    }

    public function testCanNotCreateUserOnWrongUsername()
    {
        $data = [
            'username' => '2testUsername',
            'role' => 'ADMIN',
            'email' => 'testUsername@gmail.com',
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
            'role' => 'ADMIN',
            'email' => '2testUsername@gmail.com',
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
            new Email('testDeleteUsername@gmail.com'),
            new Role('ADMIN'),
            []
        );
        $this->userRepository->create($user);
        $returnedUser = $this->userQuery->getByUsername('testDeleteUsername');

        $response = $this->client->delete('nginx/api/users/' . $returnedUser->getId(), [
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
