<?php

namespace App\Domain\User;

use App\Application\Command\ActivateAccountCommand;
use App\Application\Command\ChangePasswordCommand;
use App\Application\Command\CreateUserCommand;
use App\Domain\ActivationToken\ActivationToken;
use App\Domain\ActivationToken\ActivationTokenRepositoryInterface;
use App\Domain\Exception\InvalidArgumentException;
use App\Services\EmailService\EmailServiceContext;
use App\Services\Symfony\Security\SessionAuth\SessionAuthUser;
use App\Domain\User\Exception\EmailAlreadyExistsException;
use App\Domain\User\Exception\UserAlreadyExistsException;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\Password;
use App\Domain\User\ValueObject\Role;
use App\Domain\User\ValueObject\Username;
use App\Infrastructure\Exception\NotFoundException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var ActivationTokenRepositoryInterface */
    private $activationTokenRepository;

    /** @var EncoderFactoryInterface */
    private $passwordEncoder;

    /** @var ContainerInterface  */
    private $container;

    /** @var RouterInterface  */
    private $router;

    /** @var EmailServiceContext */
    private $context;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param ActivationTokenRepositoryInterface $activationToken
     * @param EncoderFactoryInterface $passwordEncoder
     * @param ContainerInterface $container
     * @param RouterInterface $router
     * @param EmailServiceContext $context
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ActivationTokenRepositoryInterface $activationToken,
        EncoderFactoryInterface $passwordEncoder,
        ContainerInterface $container,
        RouterInterface $router,
        EmailServiceContext $context
    ) {
        $this->userRepository = $userRepository;
        $this->activationTokenRepository = $activationToken;
        $this->passwordEncoder = $passwordEncoder;
        $this->container = $container;
        $this->router = $router;
        $this->context = $context;
    }

    /**
     * @param CreateUserCommand $command
     * @throws EmailAlreadyExistsException
     * @throws InvalidArgumentException
     * @throws UserAlreadyExistsException
     * @throws \SendGrid\Mail\TypeException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function createUser(CreateUserCommand $command): void
    {
        if ($this->userAlreadyExists(new Username($command->username()))) {
            throw new UserAlreadyExistsException("Username already exists");
        }

        if ($this->emailAlreadyExists(new Email($command->email()))) {
            throw new EmailAlreadyExistsException("Email address already exists");
        }

        // If validation passed create User instance
        $user = new User(
            Uuid::uuid4(),
            new Username($command->username()),
            new Email($command->email()),
            new Role($command->role()),
            array()
        );
        $activationToken = new ActivationToken(null, $user);

        // Generate activation link
        $activationLink =  $this->router->generate(
            'activateAccount',
            [
                'token' => $activationToken->getToken()
            ],
            UrlGenerator::ABSOLUTE_URL
        );

        $success = $this->context->sendActivationEmail([
            'subject' => 'Confirm Registration on Task-Manager',
            'activation_link' => $activationLink,
            'delivery_address' => $command->email(),
        ]);

        if ($success) {
            $this->userRepository->create($user);
            $this->activationTokenRepository->create($activationToken);
        }
    }

    /**
     * @param Username $username
     * @return bool
     */
    private function userAlreadyExists(Username $username): bool
    {
        try {
            if ($this->userRepository->checkIfUsernameExists($username)) {
                return true;
            }
        } catch (NotFoundException $e) {
            return false;
        }

        return false;
    }

    /**
     * @param Email $email
     * @return bool
     */
    private function emailAlreadyExists(Email $email): bool
    {
        try {
            if ($this->userRepository->checkIfEmailExists($email)) {
                return true;
            }
        } catch (NotFoundException $e) {
            return false;
        }

        return false;
    }

    /**
     * @param ChangePasswordCommand $command
     * @throws InvalidArgumentException
     * @throws NotFoundException
     */
    public function changePassword(ChangePasswordCommand $command)
    {
        $data = [
            'password1' => $command->password1(),
            'password2' => $command->password2(),
        ];
        $this->validatePassword($data);
        $encodedPassword = $this->encodePassword($command->password1());
        $this->userRepository->changePassword($command->userId(), $encodedPassword);
    }

    /**
     * @param array $data
     * @return bool
     * @throws InvalidArgumentException
     */
    private function validatePassword(array $data): bool
    {
        if ($data['password1'] !== $data['password2']) {
            throw new InvalidArgumentException("Provided passwords doesn't match");
        }

        new Password($data['password1']); // Create Password instance to validate

        return true;
    }

    /**
     * @param string $password
     * @return string
     */
    private function encodePassword(string $password): string
    {
        $encoder = $this->passwordEncoder->getEncoder(SessionAuthUser::class);
        $encodedPassword = $encoder->encodePassword($password, getenv('APP_SALT'));

        return $encodedPassword;
    }

    /**
     * @param ActivateAccountCommand $command
     * @throws InvalidArgumentException
     * @throws NotFoundException
     */
    public function activateAccount(ActivateAccountCommand $command)
    {
        $data = [
            'password1' => $command->password1(),
            'password2' => $command->password2(),
        ];

        $this->validatePassword($data);
        $encodedPassword = $this->encodePassword($command->password1());
        $this->activationTokenRepository->activateAccount($command->token());
        $this->userRepository->activateNewUser($command->token(), $encodedPassword);
    }
}
