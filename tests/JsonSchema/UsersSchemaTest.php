<?php

namespace App\Tests\JsonSchema;

use App\Domain\User\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
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

    protected function setUp(): void
    {
        self::bootKernel();

        $container = self::$kernel->getContainer();
        $userQuery = $container->get('userQuery');
        $userRepository = $container->get('userRepository');

        $uuid = Uuid::uuid4();
        $user = new User(
            $uuid,
            new Username('username1'),
            new Password('password'),
            new Email('username1@gmail.com'),
            []);

        $userRepository->create($user);

        $securityUser = $userQuery->getSessionAuthUserByUsername('username1');
        $jwtManager = $container->get('lexik_jwt_authentication.jwt_manager');

        $this->token = $jwtManager->create($securityUser);

        $this->client = new Client([
            'allow_redirects' => true,
            'http_errors' => false,
        ]);
    }

    public function testIsGetUsersSchemaValid()
    {
        $path = dirname(__DIR__);
        $schema = Schema::fromJsonString(file_get_contents($path . '/../src/JsonSchema/get_user_schema.json'));
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

    public function testIsSchemaValid()
    {
        $path = dirname(__DIR__);
        $schema = Schema::fromJsonString(file_get_contents($path . '/../src/JsonSchema/get_user_schema.json'));
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
