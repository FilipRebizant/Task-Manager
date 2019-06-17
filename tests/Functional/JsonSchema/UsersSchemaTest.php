<?php

namespace App\Tests\Functional\JsonSchema;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use GuzzleHttp\Client;
use Opis\JsonSchema\Schema;
use Opis\JsonSchema\ValidationResult;
use Opis\JsonSchema\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersSchemaTest extends WebTestCase
{
    /** @var Client */
    private $client;

    /** @var string */
    private $token;

    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var User */
    private $user;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = self::$kernel->getContainer();
        $userQuery = $container->get('userQuery');
        $this->userRepository = $container->get('userRepository');

        $uuid = Uuid::uuid4();
        $this->user = new User(
            $uuid,
            new Username('username1'),
            new Email('username1@gmail.com'),
            new Role('ADMIN'),
            []);
        $this->user->setPassword(new Password('testpassword'));
        $token = Uuid::uuid4()->toString();

        $this->userRepository->create($this->user, $token);

        $securityUser = $userQuery->getSessionAuthUserByUsername('username1');
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

    public function testIsGetUsersSchemaValid()
    {
        $path = dirname(__DIR__);
        $schema = Schema::fromJsonString(file_get_contents($path . '/../../src/JsonSchema/get_user_schema.json'));
        $validator = new Validator();

        $response = $this->client->get('nginx/api/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ]
        ]);

        $json = json_decode($response->getBody());

        /** @var ValidationResult $result */
        $result = $validator->schemaValidation($json, $schema);

        if (!$result->isValid()) {
            $error = $result->getFirstError();
            echo '$data is invalid', PHP_EOL;
            echo "Error: ", $error->keyword(), PHP_EOL;
            echo json_encode($error->keywordArgs(), JSON_PRETTY_PRINT), PHP_EOL;
        }

        $this->assertTrue($result->isValid());
    }
}
