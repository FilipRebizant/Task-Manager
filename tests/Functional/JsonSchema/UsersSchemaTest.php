<?php

namespace App\Tests\Functional\JsonSchema;

use App\Application\Query\User\UserQueryInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use GuzzleHttp\Client;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Opis\JsonSchema\Schema;
use Opis\JsonSchema\ValidationResult;
use Opis\JsonSchema\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zalas\Injector\PHPUnit\Symfony\TestCase\SymfonyTestContainer;
use Zalas\Injector\PHPUnit\TestCase\ServiceContainerTestCase;

class UsersSchemaTest extends WebTestCase implements ServiceContainerTestCase
{
    use SymfonyTestContainer;

    /** @var User */
    private $user;

    /** @var Client */
    private $client;

    /** @var string */
    private $token;

    /**
     * @var UserQueryInterface
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
            []);
        $this->user->setPassword(new Password('testpassword'));

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

    public function testIsGetUsersSchemaValid()
    {
        $path = dirname(__DIR__);
        $schema = Schema::fromJsonString(
            file_get_contents($path . '/../../src/Services/JsonSchema/get_user_schema.json')
        );
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
